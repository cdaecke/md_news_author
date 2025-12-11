# Version 8.1.0 (2025-12-11)
- [TASK] remove dependency to `georgringer/numbered-pagination` and use `SlidingWindowPagination` of core
- [TASK] Handle deprecation: #104789 - renderStatic() for Fluid ViewHelpers
- [TASK] handle PHP 8.4 deprecates implicitly nullable types

All changes
https://github.com/cdaecke/md_news_author/compare/v8.0.3...v8.1.0

# Version 8.0.3 (2025-11-24)
- [BUGFIX] Do not use `initializeObject()` in news model but move everything to `__construct()`

All changes
https://github.com/cdaecke/md_news_author/compare/v8.0.2...v8.0.3

# Version 8.0.2 (2025-11-24)
- [TASK] Update dependency to ext:news

All changes
https://github.com/cdaecke/md_news_author/compare/v8.0.1...v8.0.2


# Version 8.0.1 (2025-11-12)
- [BUGFIX] change TCA config for field `news` in author record to `passthrough`.

All changes
https://github.com/cdaecke/md_news_author/compare/v8.0.0...v8.0.1

# Version 8.0.0 (2024-12-17)
- [FEATURE] TYPO3 v13 compatibility

All changes
https://github.com/cdaecke/md_news_author/compare/v7.0.3...v8.0.0

# Version 7.0.3 (2024-12-12)
- [TASK] Update dependency to ext:news

All changes
https://github.com/cdaecke/md_news_author/compare/v7.0.2...v7.0.3

# Version 7.0.2 (2024-02-02)
- [FEATURE] Add PageTitleProvider

All changes
https://github.com/cdaecke/md_news_author/compare/v7.0.1...v7.0.2

# Version 7.0.1 (2024-01-22)
- [TASK] Update dependency to ext:numbered_pagination

All changes
https://github.com/cdaecke/md_news_author/compare/v7.0.0...v7.0.1

# Version 7.0.0 (2023-09-22)
- [FEATURE] TYPO3 12 compatibility

# Version 6.0.8 (2022-11-07)
- [TASK] Update dependency to ext:news

All changes
https://github.com/cdaecke/md_news_author/compare/v6.0.7...v6.0.8

# Version 6.0.7 (2022-03-09)
- [TASK] Update github workflow

All changes
https://github.com/cdaecke/md_news_author/compare/v6.0.6...v6.0.7

# Version 6.0.6 (2022-03-09)
- [TASK] PHP 7.2 compatibility for upgrade wizard

All changes
https://github.com/cdaecke/md_news_author/compare/v6.0.5...v6.0.6

# Version 6.0.5 (2021-10-25)
- [BUGFIX] use "default_sortby" instead of "sortby" in tca for authors

All changes
https://github.com/cdaecke/md_news_author/compare/v6.0.4...v6.0.5

# Version 6.0.4 (2021-10-23)
- [TASK] sort author records by lastname in backend list view
- [TASK] add missing slash in Persistence/Classes.php class configuration
- [TASK] check, if author is provided in showAction. If not, redirect to page with list view.

All changes
https://github.com/cdaecke/md_news_author/compare/v6.0.3...v6.0.4

# Version 6.0.3 (2021-10-11)
- [BUGFIX] use correct version number for TYPO3 in ext_localconf.php constraints

All changes
https://github.com/cdaecke/md_news_author/compare/v6.0.2...v6.0.3

# Version 6.0.2 (2021-10-07)
- [BUGFIX] change flexform filenames uppercase
- [TASK] update palettes in news_author TCA

All changes
https://github.com/cdaecke/md_news_author/compare/v6.0.1...v6.0.2

# Version 6.0.1 (2021-10-06)
TASK: Update TYPO3 dependency in composer.json

All changes
https://github.com/cdaecke/md_news_author/compare/v6.0.0...v6.0.1

# Version 6.0.0 (2021-10-05)
- [FEATURE] TYPO3 11 compatibility
- [TASK] Dependency to ext:numbered_pagination was added.

## BREAKING
- News Author-Plugin was splited in two separate plugins, one for listing the authors and one for a detail view of an author. Use the Upgrade Wizard to migrate!
- Templates where changed.
- ShowAlphabeticalNavigationViewHelper was removed.
- New paginator was introduced, so partial needs to be change, if you use your own.
- routeEnhancers for speaking urls need to be adapted (find new configuration in the documentation).

All changes
https://github.com/cdaecke/md_news_author/compare/v5.0.1...v6.0.0

# Version 5.0.0 (2020-09-16)
[BUGFIX] get author data in news record again (with ext:news v8.4.0)

All changes
https://github.com/cdaecke/md_news_author/compare/v5.0.0...v5.0.1

# Version 5.0.0 (2020-08-04)
[FEATURE] TYPO3 10 compatibility

All changes
https://github.com/cdaecke/md_news_author/compare/v4.0.1...v5.0.0

# Version 4.0.1 (2020-01-07)
[BUGFIX] Get all news records on an authors detail page

All changes
https://github.com/cdaecke/md_news_author/compare/v4.0.0...v4.0.1

# Version 4.0.0 (2019-02-14)
[FEATURE] TYPO3 9 compatibility

ATTENTION:
Make sure to run the database analyzer in the install tool and clear the cache afterwards!

All changes
https://github.com/cdaecke/md_news_author/compare/v3.0.2...v4.0.0

# Version 3.0.2 (2019-02-04)
- [BUGFIX] Respect translations of authors in news records
- [BUGFIX] Make TCEFORM working again for TYPO3 8
- Add some more fields the author record

ATTENTION: Make sure to clear the cache in TYPO3 install tool after this update!

All changes
https://github.com/cdaecke/md_news_author/compare/v3.0.1...v3.0.2

# Version 3.0.1 (2018-02-19)
[BUGFIX] Do not allow to add the same author multiple times to the same news record

All changes
https://github.com/cdaecke/md_news_author/compare/v3.0.0...v3.0.1

# Version 3.0.0 (2017-11-30)
Add possibility to have more than one author attached to a news record

All changes
https://github.com/cdaecke/md_news_author/compare/v2.0.2...v3.0.0

# Version 2.0.2 (2017-07-10)
Fix error in list view

All changes
- 2017-07-10 [TASK] raise version number (Commit 8e65802 by chris)
- 2017-07-10 [BUGFIX] initialize arguments in ShowAlphabeticalNavigationViewHelper (Commit 1886270 by chris)

# Version 2.0.1 (2017-07-10)
- add composer.json
- fix ShowAlphabeticalNavigationViewHelper()

All changes
- 2017-07-10 [TASK] raise version number (Commit 083177d by chris)
- 2017-07-10 [BUGFIX] remove PHP warning in ShowAlphabeticalNavigationViewHelper(). Make it compatible with AbstractConditionViewHelper::render() (Commit b0eced4 by chris)
- 2017-06-28 [BUGFIX] composer.json (Commit 9d6d438 by chris)
- 2017-06-28 [DOC] add section "Bugs and Known Issues" (Commit f8599d1 by chris)
- 2017-06-28 [TASK] add composer.json (Commit b76a1f2 by chris)


# Version 2.0.0 (2017-06-14)
- add alphabetical filter for author list
- add categories for authors

All changes:
- 2017-06-14 [DOC] add categories to documentation (Commit f801e27 by chris)
- 2017-06-14 [TASK] update version number (Commit 7c47626 by chris)
- 2017-06-05 [FEATURE] add alphabetical filter to author list (Commit af24452 by chris)
- 2017-06-04 [TASK] update documentation: add list view to realURL config (Commit f75a9eb by chris)
- 2017-05-14 [TASK] add tags for ext:indexed_search in templates (<!--TYPO3SEARCH_end--> and <!--TYPO3SEARCH_begin-->) - Do not index the author list - Do not index the articles on authors detail page (Commit ecb4ec3 by chris)
- 2017-05-12 [TASK] use own pagination template (copy of the news pagination - thanks Georg Ringer!) (Commit 0fbe573 by chris)
- 2017-05-08 [TASK] add categories to authors, filter authors by categories references #1 (Commit f50f2aa by chris)
- 2017-05-06 [TASK] add pagination widget to list view (Commit 482f5d1 by chris)
- 2017-05-06 [TASK] change version number to DEV (Commit c54a599 by chris)
