# sql-remove-html
Copy a database column to a new one with HTML tags removed. Currently only works with SQLite databases.
## Usage
* `composer install`
* Copy `.env.sample` to `.env`
* Fill the `.env` variables as follow :
    - **SRH_DATABASE** : Path to your database
    - **SRH_TABLE** : Name of the table containing the column to copy
    - **SRH_ORIGINAL_COL** : The column countaining the HTML formatted text to copy
    - **SRH_COPY_COL** : The name of the column to be created in which the HTML free version of the previous column will be copied
* `php sql-remove-html`
* ????
* PROFIT!!!
