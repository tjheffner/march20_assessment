##Developers
Tanner Heffner

##Date
March 20, 2015

##Description
This assessment is to "create an app for a hair salon. The owner should be able to add a list of their stylists, and for each stylist, add clients who see that stylist. The stylists work independently, so each client only belongs to a single stylist."

##Use and Editing
To use the app, download the source code and run it in on your php server.
To edit the app, download the source code and open it in your text editor.

    *Note: If you are copying any of the code to your own directories, you may need to install Composer
    in your root directory.*

##PSQL stuff
To use the database, create a database in psql named "hair_salon", then use the command \i hair_salon.sql
  - To check the tests, you'll also need to create the database "hair_salon_test" using the template from "hair_salon"

If that doesn't work, the commands I used to create my database were:
CREATE DATABASE hair_salon;
\c hair_salon
CREATE TABLE stylists (id serial PRIMARY KEY, name varchar);
CREATE TABLE clients (id serial PRIMARY KEY, c_name varchar, stylist_id int);
CREATE DATABASE hair_salon_test WITH TEMPLATE hair_salon;


##Copyright (c) 2015 Tanner Heffner

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
