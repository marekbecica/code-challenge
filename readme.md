# Laravel Code Test

This code test involves the creation of a working project with the help of the Laravel framework.
The task is split into three sub-categories and shouldn't take longer than 2-4 hours of your time.

###Prerequisites
This code test does not involve any use of caching or database connections. Therefore, you can clone this repository locally as long as you have php >= 7.1.3 installed on your machine. Alternatively, you can install a VM such as Homestead.

1. Option (php cli)

    On Debian/Ubuntu machines, you can simply install everyting needed via apt, given you have the correct apt repository configured:

    `sudo add-apt-repository -y ppa:ondrej/php`
    
    `sudo apt install composer php7.3-common php7.3-cli php7.3-json php7.3-mbstring php7.3-xml php7.3-opcache php7.3-readline php7.3-pdo php7.3-ctype php7.3-bcmath`

    Open a terminal and clone this repository into any directory on your machine, then and run `composer install` and `php artisan serve --port=8888` to start the web server, reachable under `http://localhost:8888`

1. Option (Homestead)
- For this, you need to have a hypervisor installed on your machine, such as vmware, virtualbox, parallels or hyper-v. We recommend to install the free [Virtual Box](https://www.virtualbox.org/wiki/Downloads). If you choose to use a different hypervisor, please edit the Homestead.yaml file accordingly ("provider")
- In order for the custom domain **homestead.test** to work, you need to add it to your hosts-file (usually under /etc/hosts): `192.168.99.99 homestead.test`. For a quick fix run `sudo sh -c 'echo "192.168.99.99 homestead.test" >> /etc/hosts'` in your terminal.
- Now you simply run the command `vagrant up`, then `vagrant ssh -c "cd ~/code; composer install"` and your application will be available under the address http://homestead.test


###Hints
This repository has been set up for you to start right away. In case you are not familiar with Laravel, here a few hints:
- The routes can be found and configured in the file `routes/web.php`.
- A first controller can be found here: `app/Http/Controllers/SearchController.php`.
- The views can be found under `resources/views`.
- Publicly accessible assets can be placed into the `public/` folder and its sub-directories.

We already created the two routes `/` and `/search` which point to the controller methods `index` and `search` which respectively return the views `index.blade.php` and `search.blade.php`.

###Restrictions
1. Please do **NOT** use any JS/AJAX to solve this challenge but build it in PHP. 
2. You can use any libraries you can find and make use of.
3. This challenge doesn't focus on the UI. Do not spend too much time on layout/css.

###The Challenge
Implement the following functionality by using the official Spotify Developer's API. You can create an account [here](https://developer.spotify.com/dashboard/). Find out how to use their API in order to fulfill the implementation goals.


