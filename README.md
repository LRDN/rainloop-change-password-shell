Shell Password Change
=====================

[Rainloop Webmail](https://github.com/rainloop/rainloop-webmail) plugin that adds the functionality to change the email account password of a local user.

Installation
------------

Clone this repository into your plugins directory.

```sh
git clone https://github.com/lrdn/rainloop-change-password-shell.git change-password-shell
```

In order for the password change to function you're required to add sudo permissions for `/usr/bin/passwd` to your web server user, in this example `www-data`. Additionally you need to assign a user group like `mailusers` to all email accounts for which the password change by the web server is granted.

```sh
touch /etc/sudoers.d/mailusers
echo "Defaults:www-data targetpw, timestamp_timeout=0" >> /etc/sudoers.d/mailusers
echo "www-data ALL=(%mailusers) /usr/bin/passwd" >> /etc/sudoers.d/mailusers
chmod 440 /etc/sudoers.d/mailusers
```

Configuration
-------------

1. Open the webmail admin panel
2. Go to `Plugins` and enable `change-password-shell`

In the plugin configuration you have the option to restrict access to the password change setting to certain email addresses and domains.