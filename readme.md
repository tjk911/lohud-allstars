# Lohud All Stars

This is the card system used to power Lohud's 2015 All Stars page.

 * Auto generated responsive cards
 * Individually embeddable cards for Presto CMS use
 * Form UI for adding new cards
 * Does not require the use of a database


Will eventually fork it into a proper card system for use beyond the all stars page, but if anyone wants to grab this and take a run at it feel free to do so. A fair bit of messy code still..

### Known issues

 * Flip card does not work optimally on iOS devices
 * Cards currently generated by jquery instead of PHP
 * Form validation needs to be re-worked
 * Missing social share
 * Images require specific sizes, does not auto resize

### Some considerations
A conscious choice was made to skip a proper database so that it's easier to deploy, and we do not anticipate multiple users adding new cards at the same time either as its envisioned user are a select few reporters/editors. 

If your project's content is to be added by the public or a high number of users, I highly recommend rewriting this to connect to a database.

I believe there are ways to lock the json file as well using PHP, but I've yet to explore that myself.


##

### Stuff used to make this:

 * [Zurb's Foundation 5](http://foundation.zurb.com/) for framework
 * [Table to JSON](http://lightswitch05.github.io/table-to-json/) for saving the entire table back into a json file
 * [David Walsh's flip card CSS](http://davidwalsh.name/css-flip) for that flip card effect
