
## Git Good Practices

### Set Your Committer Name & Email
To set your personal infos run the following command, paying attention to use your name and surname
and email

```bash
git config user.name "John Doe"
git config user.email "john@doe.org"
```
Some hints [here](https://www.git-tower.com/learn/git/faq/change-author-name-email)

Commit all your changes in your own branch. Before making any code change, start a new Git branch where all your changes will be made.



## Coding Standard

- Ensure you stick to the [WordPress Coding Standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/).

Run the following command from the root directory to check the code for "sniffs".
```bash
npm run composer run-script check-cs
```

If you were unable to install the Docker program, as an alternative, you can [install composer the traditional way](https://getcomposer.org/download/) and run this command to check for "sniffs".

```bash
vendor/bin/phpcs -ps
```



## Creating a stable release

Contributors who want to make a new release, follow these steps:

1. Change the plugin `version` header field in the [main plugin file](write-poetry.php) and the `Stable tag` field in the Header informations of [readme.txt](readme.txt) file following the [WordPress versioning scheme](https://make.wordpress.org/core/handbook/about/release-cycle/version-numbering/)

**N.B.: Don't forget to update the changelog with the details of the changes made in the new version.**


2. Add a git tag to the last commit with the same number of the plugin version, like this:
```bash
git tag -a 0.2.1 HEAD -m "Release 0.2.1"
```
3. To trigger the release GitHub Action run:
```bash
git push --tags
```
