# WordPress Bfsb Plugin

## Requirement 
- Composer [HERE](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos)
- Nodejs [HERE](https://nodejs.org/en/download/)
- PHP >= 8.0.11 
## install
- Clone git repository
```shell script
git clone git@github.com:therakib7/bfsb.git
cd bfsb
```
- Generate vendor autoload files
```shell script
composer dumpautoload -o 
```
- Install Node package
```shell script
npm install
```

## Changes
- You need to change BFSB Project to your plugin name
- You need to change bfsb to your plugin slug
- Set name space composer.json psr-4 to tour unique namespace for the app folder
```json
{
  "Bfsb\\": "app"
}
```
- Rename app/Bfsb.php to your app class name
```php
final class Bfsb{

}
// TO =>
final class YourPluginInitClass{

}
//================ Start up function ==============
function bfsb() {
    return Bfsb::getInstance();
}

bfsb();
// TO =>
function your_bfsb_function() {
    return Bfsb::getInstance();
}

your_bfsb_function();
```

## NPM Helper comment
```shell script
npm run dev
```
```shell script
npm run prod
```  
```shell script
npm run package 
``` 
```shell script
npm run zip 
``` 

## Task list
- [ ] Add Laravel mix support to compile gutenberg block 
- [ ] Add some helper Class 
- [ ] Add some feature that can add extra functions to a class