#!/bin/bash
# VICIdial on AlmaLinux 8 Installation Script
# (ViciBox 9/11/12 Alternative)
# Usage: sudo bash vicidial-almalinux8-install.sh

set -e

echo "=========================================="
echo "VICIdial on AlmaLinux 8 Installation"
echo "=========================================="

# 1) Prepare system
echo "[1/10] Preparing system..."
sudo dnf -y update
sudo dnf -y install epel-release
sudo dnf config-manager --set-enabled powertools 2>/dev/null || sudo dnf config-manager --set-enabled crb
sudo dnf -y groupinstall "Development Tools"
sudo dnf -y install wget curl vim git tar chrony firewalld policycoreutils-python-utils
sudo systemctl enable --now chronyd firewalld

# Set hostname (replace with your FQDN)
read -p "Enter hostname (e.g., dialer01.example.com): " HOSTNAME
sudo hostnamectl set-hostname "$HOSTNAME"

# 2) Install MariaDB
echo "[2/10] Installing MariaDB..."
sudo dnf -y install mariadb-server
sudo systemctl enable --now mariadb

# Secure MariaDB (interactive)
echo "Running mysql_secure_installation..."
sudo mysql_secure_installation

# Create VICIdial database and user
echo "[3/10] Creating VICIdial database and user..."
read -sp "Enter MariaDB root password: " ROOT_PASS
echo
read -sp "Enter cron user password: " CRON_PASS
echo

mysql -u root -p"$ROOT_PASS" <<EOF
CREATE DATABASE asterisk DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'cron'@'localhost' IDENTIFIED BY '$CRON_PASS';
GRANT ALL PRIVILEGES ON asterisk.* TO 'cron'@'localhost';
FLUSH PRIVILEGES;
EOF

# 3) Install web stack + Perl modules
echo "[4/10] Installing Apache, PHP, and Perl modules..."
sudo dnf -y install httpd php php-mysqlnd php-gd php-mbstring php-xml php-cli php-json php-process
sudo dnf -y install perl perl-DBI perl-DBD-MySQL perl-Time-HiRes perl-Net-Telnet perl-JSON perl-YAML \
  perl-Archive-Tar perl-libwww-perl perl-LWP-Protocol-https perl-Sys-Hostname-Long perl-Term-ReadKey \
  sox screen
sudo systemctl enable --now httpd

# 4) Install Asterisk dependencies
echo "[5/10] Installing Asterisk dependencies..."
sudo dnf -y install jansson jansson-devel libxml2 libxml2-devel ncurses ncurses-devel \
  openssl openssl-devel sqlite sqlite-devel newt newt-devel libuuid libuuid-devel

# 5) Build and install Asterisk
echo "[6/10] Building Asterisk (this may take 10-20 minutes)..."
cd /usr/src
sudo wget -q http://downloads.asterisk.org/pub/telephony/asterisk/asterisk-18-current.tar.gz
sudo tar xzf asterisk-18-current.tar.gz
ASTERISK_DIR=$(ls -d asterisk-18.* | head -1)
cd "$ASTERISK_DIR"
sudo contrib/scripts/install_prereq install
sudo ./configure --silent
sudo make menuselect.makeopts
sudo make -j"$(nproc)" 1>/dev/null
sudo make install 1>/dev/null
sudo make samples
sudo make config
sudo ldconfig

# Create asterisk user and set permissions
sudo useradd -r -d /var/lib/asterisk -s /sbin/nologin asterisk 2>/dev/null || true
sudo chown -R asterisk:asterisk /var/lib/asterisk /var/log/asterisk /var/spool/asterisk /etc/asterisk /var/run/asterisk
sudo sed -i 's/^#AST_USER=.*/AST_USER="asterisk"/' /etc/sysconfig/asterisk
sudo sed -i 's/^#AST_GROUP=.*/AST_GROUP="asterisk"/' /etc/sysconfig/asterisk
sudo systemctl enable asterisk

# 6) Get VICIdial source
echo "[7/10] Installing VICIdial..."
cd /usr/src
sudo git clone https://github.com/inktel/Vicidial.git vicidial 2>/dev/null || true
cd vicidial

# Import schema
echo "Importing VICIdial database schema..."
mysql -u cron -p"$CRON_PASS" asterisk < extras/MySQL_AST_CREATE_tables.sql
mysql -u cron -p"$CRON_PASS" asterisk < extras/first_server_install.sql

# Install web files
sudo mkdir -p /var/www/html/vicidial
sudo cp -r www/* /var/www/html/ 2>/dev/null || true
sudo chown -R apache:apache /var/www/html

# Copy Perl scripts
sudo mkdir -p /usr/share/astguiclient
sudo cp agi-bin/*.pl /usr/share/astguiclient/ 2>/dev/null || true
sudo chown -R asterisk:asterisk /usr/share/astguiclient

# 7) Configure VICIdial
echo "[8/10] Configuring VICIdial..."
read -p "Enter server IP address: " SERVER_IP

sudo tee /etc/astguiclient.conf > /dev/null <<EOF
VARDB_server=localhost
VARDB_database=asterisk
VARDB_user=cron
VARDB_pass=$CRON_PASS
VARDB_port=3306
VARserver_ip=$SERVER_IP
VARserver_label=ALMA8DIALER
VARactive_keepalives=1
VARasterisk_version=18
VARasterisk_manager_user=admin
VARasterisk_manager_pass=admin
EOF

sudo chown asterisk:asterisk /etc/astguiclient.conf
sudo chmod 600 /etc/astguiclient.conf

# 8) Setup cron jobs
echo "[9/10] Setting up cron jobs..."
sudo tee /etc/cron.d/vicidial > /dev/null <<'EOF'
### VICIDIAL baseline jobs
* * * * * asterisk /usr/share/astguiclient/AST_manager_send.pl
* * * * * asterisk /usr/share/astguiclient/AST_VDauto_dial.pl --debugX=0
* * * * * asterisk /usr/share/astguiclient/AST_VDremote_agents.pl
* * * * * asterisk /usr/share/astguiclient/AST_VDadapt.pl --debugX=0
* * * * * asterisk /usr/share/astguiclient/AST_cleanup_agent_log.pl
* * * * * asterisk /usr/share/astguiclient/AST_manager_kill_hung_congested.pl
EOF

# 9) Configure SELinux and Firewall
echo "[10/10] Configuring firewall..."
sudo setenforce 0 2>/dev/null || true
sudo sed -i 's/^SELINUX=.*/SELINUX=permissive/' /etc/selinux/config

sudo firewall-cmd --permanent --add-service=http
sudo firewall-cmd --permanent --add-service=https
sudo firewall-cmd --permanent --add-port=5060/udp
sudo firewall-cmd --permanent --add-port=10000-20000/udp
sudo firewall-cmd --reload

# 10) Start services
echo "Starting services..."
sudo systemctl restart mariadb httpd asterisk

# Verification
echo ""
echo "=========================================="
echo "Installation Complete!"
echo "=========================================="
echo ""
echo "Verify installation:"
echo "  sudo asterisk -rx 'core show version'"
echo "  sudo asterisk -rx 'sip show peers'"
echo ""
echo "Web interface:"
echo "  http://$SERVER_IP/vicidial/admin.php"
echo ""
echo "Log files:"
echo "  /var/log/asterisk/messages"
echo "  /var/log/httpd/error_log"
echo "  /var/log/mariadb/mariadb.log"
echo ""







