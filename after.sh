if [ ! -f ~/.homestead_post_install_customisations ]; then
    # Add one time setup customisation
    echo "installing setup customisations"

    echo "host    all             all             0.0.0.0/0                md5" | sudo tee -a /etc/postgresql/9.5/main/pg_hba.conf
    sudo /etc/init.d/postgresql reload
    # service postgresql restart

    touch ~/.homestead_post_install_customisations
else
    # Add setup constomisation that should run with each reload/provision
    echo "installing reload/provisioning customisations"
fi

sudo touch /etc/php/7.1/cli/conf.d/99.xdebug.ini
sudo chmod 777 /etc/php/7.1/cli/conf.d/99.xdebug.ini

sudo cat << EOS > /etc/php/7.1/cli/conf.d/99.xdebug.ini
zend_extension=xdebug.so
xdebug.remote_enable = 1
xdebug.remote_connect_back = 1
xdebug.remote_port = 9000
xdebug.max_nesting_level = 512
EOS