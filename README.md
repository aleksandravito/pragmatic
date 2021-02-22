# TradesFactor

TradesFactor is a SaaS product and talent management solution designed specifically for skilled trades workers, the companies that employ them, and the organizations that train them.


## Installation

Inside the .zip folder, there are a couple of files and the folder of images, also the .sql file where I have inserted 30 data from the actual site.

## Usage

the primary file is test.php, and the part of outputting a list of jobs is created without using any library of CSS or Javascript. 
At first, the limit is 5 jobs per page, then depending on the page variable from URL ( using GET method ), it changes the limit of jobs per page. This limit is used in the SQL query where I want to fetch from the database an x limit of rows and start/offset from a certain row. 
