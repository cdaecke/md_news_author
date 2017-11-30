# TYPO3 Extension ``md_news_author``

This extension is based on extbase & fluid and provides the famous extension ``ext:news`` of Georg Ringer (thanks a lot!) with one or more authors. You can centrally manage authors and attach them to news records. The extensions comes with a plugin, which lists all authors and provides a detail page of one author which also shows the news records of the selected author.

## Requirements

- TYPO3 > 7.6
- ext:news > 4.0

### Installation

- Install the extension by using the extension manager
- Include the static TypoScript of the extension
- Configure the extension by setting your own constants

## Usage

### Create authors and attach them to news records

- Create some author records on a sysfolder (use list modul, push plus-icon [*Create new record*] and select *News Author*)
- Create a news record on a sysfolder and find the new tab *Author*
- Select one or more authors for the news record
- Save and close

### List authors

Insert paginated list of all authors.

- Create a plugin *News Author* on a page
- Choose the value *List authors* in *Plugin settings*
- Choose for *Page with single author view* the page with single author view
- Select the sysfolder where the author records are stored
- Additional settings can be found in the tab *List view settings*
- If needed, show authors of certain categoreies only (tab *Categories*)
- Save and close

### Authors detail page

Insert a author detail view. This page includes also all news which are associated with the choosen author.

- Create a plugin *News Author* on a page
- Choose the value *Author details* in *Plugin settings*
- Optionally choose for *Page with author list* the page with the list of all authors
- Select the sysfolder where the author records are stored
- Additional settings can be found in the tab *List view settings*
- Save and close

### Show author in ``ext:news`` view

- Access the author properties in a news record with {newsItem.newsAuthor}. Since there could be more than one author attached to a news record, you have to iterate:

```
<f:for each="{newsItem.newsAuthor}" as="author">
    {md:ShowAuthorName(author:'{author}')}
    {author.phone}
    {author. ...}
</f:for>
```

- Add a link to the profile page

Don't forget to load the viewhelper {namespace md=Mediadreams\MdNewsAuthor\ViewHelpers}:

    <f:for each="{newsItem.newsAuthor}" as="author">
        <f:link.action action="show" controller="NewsAuthor" extensionName="mdnewsauthor" pluginName="newsauthor" arguments="{newsAuthor: author}" pageUid="{settings.newsAuthor.authorDetailPid}" title="More about {md:ShowAuthorName(author:'{author}')}">
            <md:ShowAuthorName author="{author}" />
        </f:link.action>
    </f:for>

### Page TSconfig

In order to show only authors of a single page in the "Authors"-tab of a news record, you can use the following TSconfig:

    TCEFORM.tx_news_domain_model_news.news_author.PAGE_TSCONFIG_STR = AND tx_mdnewsauthor_domain_model_newsauthor.pid = 1

This will show only the author records, which are stored on page ID = 1

### ``ext:realurl`` configuration

Thanks for this great extension, Dmitry Dulepov!

    'postVarSets' => array(
        '_DEFAULT' => array(

            // EXT:md_news_author
            'author' => array(

                '0' => array(
                    'GETvar' => 'tx_mdnewsauthor_newsauthor[action]',
                    'noMatch' => 'bypass',
                ),

                '1' => array(
                    'GETvar' => 'tx_mdnewsauthor_newsauthor[controller]',
                    'noMatch' => 'bypass',
                ),

                '2' => array(
                    'GETvar' => 'tx_mdnewsauthor_newsauthor[newsAuthor]',
                    'lookUpTable' => array(
                        'table' => 'tx_mdnewsauthor_domain_model_newsauthor',
                        'id_field' => 'uid',
                        'alias_field' => 'concat(firstname, " ",lastname)',
                        'addWhereClause' => ' AND NOT deleted',
                        'useUniqueCache' => 1,
                        'useUniqueCache_conf' => array(
                            'strtolower' => 1,
                            'spaceCharacter' => '-',
                        ),
                        'languageGetVar' => 'L',
                        'languageExceptionUids' => '',
                        'languageField' => 'sys_language_uid',
                        'transOrigPointerField' => 'l10n_parent',
                        'autoUpdate' => 1,
                        'expireDays' => 180,
                    ),
                ),
            ),

            'authorList' => array(
                '0' => array(
                    'GETvar' => 'tx_mdnewsauthor_newsauthor[action]',
                    'noMatch' => 'bypass',
                ),

                '1' => array(
                    'GETvar' => 'tx_mdnewsauthor_newsauthor[controller]',
                    'noMatch' => 'bypass',
                ),
            ),

            // sorting
            'a-z' => array(
                array(
                    'GETvar' => 'tx_mdnewsauthor_newsauthor[selectedLetter]',
                ),
            ),

            // EXT:md_news_author end
            
        ),
    ),

## Bugs and Known Issues
If you find a bug, it would be nice if you add an issue on [Github](https://github.com/cdaecke/md_news_author/issues).

# THANKS

Thanks a lot to all who make this outstanding TYPO3 project possible!
