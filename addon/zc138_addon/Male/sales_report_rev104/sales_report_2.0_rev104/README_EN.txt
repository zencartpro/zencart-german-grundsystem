SALES REPORT
Version 2.0
By Frank Koehl (PM: BlindSide)

Sponsored by Destination ImagiNation, Inc.
www.destinationimagination.org

Color scheme and icons by Kim
www.templates-for-zen-cart.com

This script is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE.

Released under the General Public License (see LICENSE.txt)

Always backup your files and database before making changes!



=====================================
  Find a bug?  Have a feature idea?
=====================================
LET ME KNOW!
All questions, comments, concerns, and wisecracks are welcome.

Zen Forum PM: BlindSide
Forum thread:
http://www.zen-cart.com/forum/showthread.php?p=253173#post253173


=========
 INTRO
=========
This report was designed to offer professional-level accounting data for businesses
who use Zen Cart heavily, with multiple display options, several levels of data
output, and flexible search options.  It was tested (and now currently used) by a
full-time accountant and bookkeeper in a Zen Cart shop with 6500 orders (and counting)
and grossing almost $1 million in sales.  If it works for them, it should work for you.

The features are explained briefly below, but the report has been built with usability
in mind, even for the most simplistic of users.  Using the report should be fairly
obvious and self-explanatory, but please let me know if you feel something can be
tweaked/added/removed to offer a more user-friendly experience.

Note that JavaScript is required to run this report.

For the developers among you, I hope you'll find the comments included throughout the
files sufficient to create whatever modifications you desire.  I only ask that you let
me know what you have created, in case it could be useful enough to add back into the
source (for which you would of course get credit).

Thanks for downloading the Sales Report, and enjoy!

--
Frank



===========
 INSTALL
===========
1. Download the package and unzip to a temp directory.

2. OPTIONAL - Set report search criteria defaults.
              See REPORT DEFAULTS below for instructions.

3. Copy the entire "admin" folder in the English_Adminpanel to the root of your shop. The files are already
   arranged and there are *no* overwrites!

   Updating from the old Sales Report?  Don't worry!  The new version maintains the
   same filenames, so simply overwrite all conflicting files.  Again, you should
   always be sure to back up before making any changes.

4. OPTIONAL - Edit admin/includes/general.js to allow rollover animation.
              See ROLLOVER below for instructions.

5. That's it!  You'll find "Sales Report" under "Reports" in the Admin.


 REPORT DEFAULTS
-------------------
With this report you may configure what search settings appear when the report opens.
These settings will also load when the "Report Defaults" button is clicked.

1. Open admin/includes/languages/english/stats_sales_report.php
2. Set the defaults as described under the "DEFAULT SEARCH OPTIONS" heading, and in
   the comments next to each "DEFAULT_" define.
3. Save and upload the modified language file.


 ROLLOVER
------------
1. Open admin/includes/general.js

2. FIND the line that reads as follows:
        if (object.className == 'dataTableRow') object.className = 'dataTableRowOver';

3. Make a new line under it and ADD the following 2 lines of code:
        if (object.className == 'totalRow') object.className = 'totalRowOver';
        if (object.className == 'lineItemRow') object.className = 'lineItemRowOver';

4. FIND the line that reads as follows:
        if (object.className == 'dataTableRowOver') object.className = 'dataTableRow';

5. Make a new line under it and ADD the following 2 lines of code:
        if (object.className == 'totalRowOver') object.className = 'totalRow';
        if (object.className == 'lineItemRowOver') object.className = 'lineItemRow';



============
 FEATURES
============
 Date Range
--------------
  - Ability to choose from a list of common date ranges, or enter a custom date range
  - Date search may apply to EITHER...
        > date of purchase or the
        > date a specific status was applied

 Filters
-----------
  - Filter orders by payment method
  - Filter orders by currently applied order status

 Reported Data
-----------------
  - Totals per timeframe
  - Totals per timeframe PLUS one of following...
        > break out by order
        > break out by product
        > high-level summary statistics

 Sorting Data
----------------
  - Group date ranges into one of four "timeframes:" single day, every 7 days, every
    calendar month, or every calendar year
  - Sort timeframes in ascending or descending chronological order

 Display Format
------------------
  - Screen display: includes normal admin nav header and report search boxes
  - Print format: headers removed, data optimized for printing on 8.5 x 11 paper;
                  (hint: the page title is a link to return the report to display format)
  - CSV Export: data arranged for import to another program; viewable in MS Excel.



==============================
 FREQUENTLY ASKED QUESTIONS
==============================
"Help! The [insert column here] is showing up as ####### when I open the CSV file in Excel!"
-----
That happens when the data is too big for the current column width.  Just widen the column
and the data will "automagically" appear.  Now be thankful you didn't post that question in
the forums.  ;)


"How come the CSV export for order/product line items does not have the timeframe total line?"
-----
The CSV export option is designed to move Zen Cart sales data into another system.  In order
to import from a CSV file, the importing program must know what format the data will be in,
and that format must remain consistent.  The timeframe total line breaks the data's
consistency, and therefore it is not displayed.  If you want timeframe lines, run the same
report again in CSV export mode, choosing just the timeframe totals.


"How come the currency data is not formatted as currency in the CSV export?"
-----
The rationale is the same as that provided in the previous answer.  It's assumed that
you're importing to a program that has some ability to perform math calculations. Your
dollar/pound/yen symbol would likely prevent that program from reading the value properly.


"If I run the report for a big date range, the report runs really slow.  My server
specs are awesome, so it must be your report.  What's the problem?  What can I do?"
-----
As one look at the class file will tell you, the Sales Report is not merely reporting
back data stored in the database; it runs calculations, sometimes very complicated ones.
I've already optimized the number of database queries as much as I can without
sacrificing data (maximum of 6 in "Timeframe Statistics" display).

If the report is slow and you want to show product line items, you can speed it up by
disabling the DISPLAY_MANUFACTURER setting in the language file to 'false'.  That saves
one database query per product, and will have a noticeable effect on large quantities
of different products.

Otherwise, you'll have to resort to adjusting your search settings.  Break your report
into several smaller runs, or limit the returned data to the timeframe total lines
(i.e. drop order or product line items).  The "Timeframe Statistics" option is the most
complicated report, pulling all the data for both product and order line items, then
running additional calculations on all of it.  I strongly recommend against running it
for more than a month's worth of data at a time; you *can* bring your server to its
knees by doing so, no matter how awesome it is.

Report performance will also depend heavily on the power of your server.  If you bought
that shared hosting package because it cost $5/month, don't expect to get any
processor priority.  Remember, you get what you pay for.

Finally, you may have to just accept the lag and wait for the report.  In this case, be
sure to ramp up the timeout period on your browser, to ensure the report can complete
and return the results.


"Can I make a donation?"
-----
Absolutely, your support really does help!

PayPal donations can be directed to fkoehl@gmail.com.

//////////////////////////////////////////////////////////////////////////////////////
README version:
$Id: README.txt 95 2006-08-29 02:43:33Z BlindSide $