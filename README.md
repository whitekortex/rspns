# RSPNS Theme Test

#### The problem
On the contact page, there is a form that sends via ajax.
There  a couple of problems with it:
- there is no way to add options/emails through the admin
- the email address per option is visible when looking at the code.

*Both of these problems need to be fixed*

#### The task:
There needs to be a way in the admin to add/edit options for the form select element

- Using ACF and ACFComposer, create acf fields via code to enable adding options. There is a sample file (app > ACF > sample.php). You will need to add a new file acf.contact.php, and add the ACF composer code in here
- Pull these options into the vue file (resources > scripts > vue > ContactUs.vue)
- Dull the options into the ajax action (app > ajax.php)
- **You cannot use another theme, or plugins to solve this task.** You must use the codebase provided.


#### To Consider:
- The form may end up on several pages, but the options would all come from the one place in the admin
- The solution needs to account for development/staging/production and shouldnt be tightly coupled to anything specific to one particular setup
- The email addresses should not be visible in the vue dev tools, or anywhere else in front-end code visible through the inspect window
- There can be multiple emails to any option
- You can use any method you want to run the site locally, however we prefer using Laravel Valet


#### Setup:
Using the repository access provided:

-   We recommend using Valet to run the website locally. https://laravel.com/docs/8.x/valet
-   Clone the repository locally
-   Using the command line, run 'composer install' from the root folder
-   Using the command line, run 'composer install' from within the test theme folder
-   Using the command line, run 'yarn' from within the test theme folder
-   Using the command line, run 'yarn bud install
-   create a `.env` file in the root directory, and follow the `.env.example`. You will need to add your local DB settings
-   in the wp-admin, add the following api key to the sendinblue plugin settings:
    ` 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 `
-   Create a new page called 'Contact Us' with a slug of 'contact-us'
-   Create a new branch for your work
-   Create a ACF file called "acf.contact.php". There is a sample ACF base within the ACF folder.
-   Create the ACF fields via code withing this file. (see: https://github.com/flyntwp/acf-field-group-composer)
-   The CPT should have a rewrite for individual posts with the slug 'product'
-   The acf fields should be the following:
    - Contact Options _(tab)_
        - Options _(repeater)_
            - Option
            - Emails
-   Pull the options into the vue component
-   Add your changes to the ajax file
-   **You will need a bit bucket account** in order submit a pull request. Send your manager your Bitbucket ID, and will will add you to the user groups.
-   When finished, create a pull request with any notes you deem useful.
-   **If you do not wish to submit a pull request**, we will need some kind of zip download with your git files intact