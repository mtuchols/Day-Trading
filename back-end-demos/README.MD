README.MD
BACK-END-DEMOS

Day.js and Min.js can be executed using the node through the command line ie:
$node min.js

Both of these files are essentially the same exepct for modified parameters in the functions.

The most important part of this code is the function getAggregateBars, which returns an object containing the
ticker prices based on the parameters passed, which in turn preforms an HTTPS API call to polygon.io using the axios API.
