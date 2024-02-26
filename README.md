#  An Email List(er) that can't mail.
Sounds a bit unlogical, right?. Like a car that cannot drive.  Well, not quite. Its a lister not a mailing list program, there are lot's of those out there. 

### So why this lister?
When you set up a sales funnel, it comprises of a couple of parts.  One of those required part is 'email-list-software'. Now there are quite some options in that arena, paid open-source take your pick.  I have spend quite some days playing around with a couple of options. One is quite expensive, the other one too ugly.  I just want something dat is simple and can handle AJAX request so we can also make it look awesome. All in all, while I'm figuring out what list software to use, my sales funnel is 'non-existant'. _(All I want, is to sell my daughters Art Work on a budget)_

And let's not forget you first need to build a list before you can use it.  So that's what this lister does.  It only builds an email list, puts it in a database for later use. And that is the only thing it does. _(When the list is too big to handle, I should have plenty of time/$$ to figure that problem out.)_

## So what is this again?
It's a php app that exposes an api that enables you to subscribe users to a list and puts this in a MySQL database. 

## Why PHP and Laravel?
It might seem a bit over the top for this small one-trick-pony, and building it in python would have been much quicker. The reasoning behind it is in short:
1) Python is not well adapted by most hosting providers for running web based applications. 
2) Using a framework like Laravel/CakePHP is always a safe bet when dealing with php/MySQL.

### Status: 
Development ready including some tests.

### API Calls:  (no authentication)
    [GET]  /api/get/mailinglist    => json array
    [POST] /api/post/subscriber    <= x-www-url-formencoded => json


Happy Hunting! 😏
