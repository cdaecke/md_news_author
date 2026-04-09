# TYPO3 Extension ``md_news_author``

This extension is based on extbase & fluid and provides the famous extension ``ext:news`` of Georg Ringer 
(thanks a lot @georgringer !) with one or more authors. You can centrally manage authors and attach them to 
news records. The extensions comes with two plugins, one for listing all authors and one for the detail page of an 
author which also shows the news records of the selected author.

## Requirements

- TYPO3 >= 13.4 or 14.x
- ext:news >= 11.0

## Installation

Install the extension via Composer:

```bash
composer req mediadreams/md_news_author
```

### Configuration via Site Sets (recommended)

Site Sets are the preferred way to configure this extension in TYPO3 >= 13.4. Add the set to your
site configuration in `config/sites/<your-site>/config.yaml`:

```yaml
dependencies:
  - mediadreams/md-news-author
```

This automatically includes all necessary TypoScript. No manual TypoScript include is needed.

You can then configure all settings directly in the **Site Management > Sites** backend module
under the **Settings** tab.

### Configuration via classic TypoScript

Alternatively, include the static TypoScript manually:

- Go to **Web > Template** and open your root template
- In the **Includes** tab, add `News Author (md_news_author)` to the list of included static templates

## Configuration

### Available settings

All settings can be configured via Site Sets or classic TypoScript constants.

| Setting | Default | Description |
|---|---|---|
| `plugin.tx_mdnewsauthor.settings.authorDetailPid` | `0` | UID of the author detail page |
| `plugin.tx_mdnewsauthor.settings.newsDetailPid` | `0` | UID of the news detail page |
| `plugin.tx_mdnewsauthor.persistence.storagePid` | `0` | UID of the sysfolder with author records |
| `plugin.tx_mdnewsauthor.settings.authorList.letters` | `A,B,...,Z` | Letters for the alphabetical filter |
| `plugin.tx_mdnewsauthor.settings.authorList.paginate.itemsPerPage` | `10` | Items per page in list view |
| `plugin.tx_mdnewsauthor.settings.authorList.paginate.insertAbove` | `false` | Show pagination above the list |
| `plugin.tx_mdnewsauthor.settings.authorList.paginate.insertBelow` | `true` | Show pagination below the list |
| `plugin.tx_mdnewsauthor.settings.authorList.paginate.maximumNumberOfLinks` | `6` | Maximum number of pagination links in list view |
| `plugin.tx_mdnewsauthor.settings.authorDetail.paginate.itemsPerPage` | `10` | Items per page in detail view |
| `plugin.tx_mdnewsauthor.settings.authorDetail.paginate.insertAbove` | `false` | Show pagination above the detail view |
| `plugin.tx_mdnewsauthor.settings.authorDetail.paginate.insertBelow` | `true` | Show pagination below the detail view |
| `plugin.tx_mdnewsauthor.settings.authorDetail.paginate.maximumNumberOfLinks` | `6` | Maximum number of pagination links in detail view |
| `plugin.tx_mdnewsauthor.view.templateRootPath` | `EXT:md_news_author/…/Templates/` | Path to Fluid templates |
| `plugin.tx_mdnewsauthor.view.partialRootPath` | `EXT:md_news_author/…/Partials/` | Path to Fluid partials |
| `plugin.tx_mdnewsauthor.view.layoutRootPath` | `EXT:md_news_author/…/Layouts/` | Path to Fluid layouts |

## Usage

### Create authors and attach them to news records

- Create some author records on a sysfolder (use list module, push plus-icon `Create new record` and select `News Author`)
- Create a news record on a sysfolder and find the new tab `Author`
- Select one or more authors for the news record
- Save and close

### List authors

Insert a paginated list of all authors.

- Create a plugin `News author: Author list` on a page
- Choose for `Page with single author view` the page with single author view
- Select the sysfolder where the author records are stored
- Additional settings can be found in the tab `List view settings`
- If needed, show authors of certain categories only (tab `Categories`)
- Save and close

### Author detail page

Insert an author detail view. This page also lists all news records associated with the selected author.

- Create a plugin `News author: Show author` on a page
- Optionally choose for `Page with author list` the page with the list of all authors
- Select the sysfolder where the author records are stored
- Additional settings can be found in the tab `Detail view settings`
- Save and close

### Show author in ``ext:news`` view

Access the author properties in a news record with `{newsItem.newsAuthor}`. Since there can be more
than one author attached to a news record, iterate over them:

```html
<f:for each="{newsItem.newsAuthor}" as="author">
    {md:ShowAuthorName(author: author)}
    {author.phone}
    {author. ...}
</f:for>
```

Add a link to the author profile page (load the viewhelper namespace first:
`{namespace md=Mediadreams\MdNewsAuthor\ViewHelpers}`):

```html
<f:for each="{newsItem.newsAuthor}" as="author">
    <f:link.action action="show" controller="NewsAuthor" extensionName="mdnewsauthor" pluginName="show"
        arguments="{newsAuthor: author}" pageUid="{settings.newsAuthor.authorDetailPid}"
        title="More about {md:ShowAuthorName(author:'{author}')}">
        <md:ShowAuthorName author="{author}" />
    </f:link.action>
</f:for>
```

### Page TSconfig

To show only authors from a specific page in the `Author` tab of a news record:

```typo3_typoscript
TCEFORM.tx_news_domain_model_news.news_author.PAGE_TSCONFIG_STR = 1
```

Replace `1` with the UID of the sysfolder containing your author records.

### ``routeEnhancers``

```yaml
routeEnhancers:
  NewsAuthorList:
    type: Extbase
    extension: MdNewsAuthor
    plugin: list
    routes:
      -
        routePath: 'page-{page}'
        _controller: 'NewsAuthor::list'
        _arguments:
          slug: 'newsAuthor'
          page: 'currentPage'
      -
        routePath: '/a-z/{letter}'
        _controller: 'NewsAuthor::list'
        _arguments:
          'letter': 'selectedLetter'
    defaultController: 'NewsAuthor::list'
    requirements:
      page: '\d+'
    defaults:
      page: '0'
    aspects:
      page:
        type: StaticRangeMapper
        start: '1'
        end: '100'
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
  NewsAuthorShow:
    type: Extbase
    extension: MdNewsAuthor
    plugin: show
    routes:
      -
        routePath: '{slug}'
        _controller: 'NewsAuthor::show'
        _arguments:
          slug: 'newsAuthor'
      -
        routePath: '{slug}/articles-{page}'
        _controller: 'NewsAuthor::show'
        _arguments:
          slug: 'newsAuthor'
          page: 'currentPage'
    defaultController: 'NewsAuthor::show'
    requirements:
      slug: '^[a-zA-Z0-9].*$'
      page: '\d+'
    defaults:
      page: '0'
    aspects:
      slug:
        type: PersistedAliasMapper
        tableName: 'tx_mdnewsauthor_domain_model_newsauthor'
        routeFieldName: 'slug'
      page:
        type: StaticRangeMapper
        start: '1'
        end: '100'
```

## Bugs and Known Issues

If you find a bug, it would be nice if you add an issue on [Github](https://github.com/cdaecke/md_news_author/issues).

# THANKS

Thanks a lot to all who make this outstanding TYPO3 project possible!

## Credits

Icons used by this extension are kindly taken from Font Awesome ([user](https://fontawesome.com/icons/user?style=solid) and [users](https://fontawesome.com/icons/users?f=classic&s=solid)).
