# TYPO3 Extension ``md_news_author``

This extension is based on extbase & fluid and provides the famous extension ``ext:news`` of Georg Ringer 
(thanks a lot @georgringer !) with one or more authors. You can centrally manage authors and attach them to 
news records. The extensions comes with two plugins, one for listing all authors and one for the detail page of an 
author which also shows the news records of the selected author.

## Requirements

- TYPO3 >= 10.4
- ext:news >= 7.0
- ext:numbered_pagination >= 1.0

### Installation

- Install the extension by using the extension manager or use composer (`composer req mediadreams/md_news_author`)
- Include the static TypoScript of the extension
- Configure the extension by setting your own constants

## Usage

### Create authors and attach them to news records

- Create some author records on a sysfolder (use list modul, push plus-icon `Create new record` and select `News Author`)
- Create a news record on a sysfolder and find the new tab `Author`
- Select one or more authors for the news record
- Save and close

### List authors

Insert paginated list of all authors.

- Create a plugin `News author: Author list` on a page
- Choose for `Page with single author view` the page with single author view
- Select the sysfolder where the author records are stored
- Additional settings can be found in the tab `List view settings`
- If needed, show authors of certain categories only (tab `Categories`)
- Save and close

### Authors detail page

Insert an author detail view. This page includes also all news which are associated with the choosen author.

- Create a plugin `News author: Show author` on a page
- Optionally choose for `Page with author list` the page with the list of all authors
- Select the sysfolder where the author records are stored
- Additional settings can be found in the tab `Detail view settings`
- Save and close

### Show author in ``ext:news`` view

- Access the author properties in a news record with `{newsItem.newsAuthor}`. Since there could be more 
than one author attached to a news record, you have to iterate:

```
<f:for each="{newsItem.newsAuthor}" as="author">
    {md:ShowAuthorName(author: author)}
    {author.phone}
    {author. ...}
</f:for>
```

- Add a link to the profile page

Don't forget to load the viewhelper `{namespace md=Mediadreams\MdNewsAuthor\ViewHelpers}`:

    <f:for each="{newsItem.newsAuthor}" as="author">
        <f:link.action action="show" controller="NewsAuthor" extensionName="mdnewsauthor" pluginName="show" arguments="{newsAuthor: author}" pageUid="{settings.newsAuthor.authorDetailPid}" title="More about {md:ShowAuthorName(author:'{author}')}">
            <md:ShowAuthorName author="{author}" />
        </f:link.action>
    </f:for>

### Page TSconfig

In order to show only authors of a single page in the "Authors"-tab of a news record, you can use the following TSconfig:

    TCEFORM.tx_news_domain_model_news.news_author.PAGE_TSCONFIG_STR = 1

This will show only the author records, which are stored on page ID = 1

### ``routeEnhancers``

```
routeEnhancers:
  NewsAuthorList:
    type: Extbase
    extension: MdNewsAuthor
    plugin: list
    routes:
      -
        routePath: '/a-z/{letter}'
        _controller: 'NewsAuthor::list'
        _arguments:
          'letter': 'selectedLetter'
    defaultController: 'NewsAuthor::list'
  NewsAuthorShow:
    type: Extbase
    extension: MdNewsAuthor
    plugin: show
    routes:
      - 
        routePath: '{slug}'
        _controller: 'NewsAuthor::show'
        _arguments:
          'slug': 'newsAuthor'
    requirements:
      slug: '^[a-zA-Z0-9].*$'
    aspects:
      slug:
        type: PersistedAliasMapper
        tableName: 'tx_mdnewsauthor_domain_model_newsauthor'
        routeFieldName: 'slug'
      letter:
        type: StaticValueMapper
        map:
          a: A
          b: B
          c: C
          d: D
          e: E
          f: F
          g: G
          h: H
          i: I
          j: J
          k: K
          l: L
          m: M
          n: N
          o: O
          p: P
          q: Q
          r: R
          s: S
          t: T
          u: U
          v: V
          w: W
          x: X
          y: Y
          z: Z
```

## Bugs and Known Issues
If you find a bug, it would be nice if you add an issue on [Github](https://github.com/cdaecke/md_news_author/issues).

# THANKS

Thanks a lot to all who make this outstanding TYPO3 project possible!

## Credits

Extension icon by [Font Awesome](https://fontawesome.com/icons/user?style=solid).
