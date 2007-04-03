{**
 * overview.tpl
 *
 * Copyright (c) 2006-2007 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Scheduled conference overview page.
 *
 * $Id$
 *}

{translate|assign:"pageTitleTranslated" key="schedConf.overview.title" schedConfAbbrev=$currentSchedConf->getSetting('abbrev')}
{include file="common/header.tpl"}

<div>{$schedConfOverview|nl2br}</div>

{include file="common/footer.tpl"}
