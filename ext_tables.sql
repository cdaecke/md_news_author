#
# Table structure for table 'tx_mdnewsauthor_domain_model_newsauthor'
#
CREATE TABLE tx_mdnewsauthor_domain_model_newsauthor (

    gender varchar(255) DEFAULT '' NOT NULL,
    title varchar(255) DEFAULT '' NOT NULL,
    firstname varchar(255) DEFAULT '' NOT NULL,
    lastname varchar(255) DEFAULT '' NOT NULL,
    slug varchar(2048),
    company varchar(255) DEFAULT '' NOT NULL,
    position varchar(255) DEFAULT '' NOT NULL,
    phone varchar(255) DEFAULT '' NOT NULL,
    email varchar(255) DEFAULT '' NOT NULL,
    www varchar(255) DEFAULT '' NOT NULL,
    facebook varchar(255) DEFAULT '' NOT NULL,
    twitter varchar(255) DEFAULT '' NOT NULL,
    xing varchar(255) DEFAULT '' NOT NULL,
    linkedin varchar(255) DEFAULT '' NOT NULL,
    bio text NOT NULL,
    image int(11) DEFAULT '0' NOT NULL,
    categories int(11) DEFAULT '0' NOT NULL,
    news int(11) DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_news_domain_model_news'
#
CREATE TABLE tx_news_domain_model_news (

    news_author int(11) unsigned DEFAULT '0',

);

#
# Table structure for table 'tx_mdnewsauthorx_news_newsauthor_mm'
#
CREATE TABLE tx_mdnewsauthor_news_newsauthor_mm (

    uid_local int(11) unsigned DEFAULT '0' NOT NULL,
    uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL,
    sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

    KEY uid_local (uid_local),
    KEY uid_foreign (uid_foreign)

);

