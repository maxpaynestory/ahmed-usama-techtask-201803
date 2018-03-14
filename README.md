# Vagrant PHP7 

A simple Vagrant LAMP setup running PHP7.

## What's inside?

- Ubuntu 14.04.3 LTS (Trusty Tahr)
- Vim, Git, Curl, etc.
- Apache
- PHP7 with some extensions
- Composer

## Prerequisites
- [Vagrant](https://www.vagrantup.com/downloads.html)
- Plugin vagrant-vbguest (``vagrant plugin install vagrant-vbguest``)
- Plugin vagrant-hostmanager ( for adding host entries to etc file)

## How to use

- Clone this repository into your project
- Run ``vagrant up``
- Add the following lines to your hosts file if hostmanager didn't worked:
````
192.168.100.135 recipeapp.vm
````
- Recipe end point for ``http://recipeapp.vm/index.php/lunch``


## How to test
 - Run ``vendor/bin/phpunit``
