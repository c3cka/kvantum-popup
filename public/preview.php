<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 25.4.2018.
 * Time: 14:54
 */

?>


<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Options</title>

    <link rel="shortcut icon" type="image/png" href="/media/images/favicon.png">
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">

    <link rel="stylesheet" href="/media/css/site.css?_=19472395a2969da78c8a4c707e72123a">
    <!--[if lte IE 9]>
    <link rel="stylesheet" type="text/css" href="/media/css/ie.css" />
    <![endif]-->

    <style>

    </style>

    <script src="/media/js/site.js?_=30af62656a8280c8984f7320f0cc0923"></script>
    <script src="/media/js/dynamic.php?comments-page=manual%2Foptions" async></script>

    <script src="js/jquery.bpopup.min.js"></script>
  </head>
  <body class="comments">
    <a name="top"></a>

    <div class="fw-background">
      <div>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>

    <div class="fw-container">
      <div class="fw-header">
        <div class="nav-master">
          <div class="nav-item active">
            <a href="/">DataTables</a>
          </div>
          <div class="nav-item">
            <a href="//editor.datatables.net">Editor</a>
          </div>
        </div>

        <div class="nav-search">
          <div class="nav-item i-manual">
            <a href="/manual">Manual</a>
          </div>
          <div class="nav-item i-download">
            <a href="/download">Download</a>
          </div>
          <div class="nav-item i-user">
            <div class="account"></div>
          </div>
          <div class="nav-item search">
            <form action="/q/" method="GET">
              <input type="text" name="q" placeholder="Search . . ." autocomplete="off">
            </form>
          </div>
        </div>
      </div>

      <div class="fw-hero">

      </div>

      <div class="fw-nav">
        <div class="nav-main">
          <ul><li class=" sub"><a href="/examples/index">Examples</a></li><li class="sub-active sub"><a href="/manual/index">Manual</a><ul><li class=""><a href="/manual/installation">Installation</a></li><li class=" sub"><a href="/manual/data">Data</a></li><li class=""><a href="/manual/ajax">Ajax</a></li><li class="active"><a href="/manual/options">Options</a></li><li class=""><a href="/manual/api">API</a></li><li class=" sub"><a href="/manual/styling">Styling</a></li><li class=""><a href="/manual/events">Events</a></li><li class=""><a href="/manual/server-side">Server-side processing</a></li><li class=""><a href="/manual/i18n">Internationalisation</a></li><li class=""><a href="/manual/security">Security</a></li><li class=" sub"><a href="/manual/plug-ins">Plug-in development</a></li><li class=" sub"><a href="/manual/tech-notes">Technical notes</a></li><li class=" sub"><a href="/manual/development">Development</a></li></ul></li><li class=" sub"><a href="/reference/index">Reference</a></li><li class=" sub"><a href="/extensions/index">Extensions</a></li><li class=" sub"><a href="/plug-ins/index">Plug-ins</a></li><li class=""><a href="/blog/index">Blog</a></li><li class=""><a href="/forums/index">Forums</a></li><li class=""><a href="/support/index">Support</a></li><li class=""><a href="/faqs/index">FAQs</a></li><li class=""><a href="/download/index">Download</a></li><li class=""><a href="/purchase/index">Purchase</a></li></ul>
        </div>

        <div class="mobile-show">
          <a><i>Show site navigation</i></a>
        </div>
      </div>

      <div class="fw-body">
        <div class="content">

          <h1 class="page_title">Options</h1>


          <p>DataTables' <a href="/reference/option">huge range of options</a> can be used to customise the way that it will present its interface, and the features available, to the end user. This is done through its configuration options, which are set at initialisation time.</p>

          <p>The <a href="/extensions">DataTables extensions</a> also each provide their own options that can be set in the DataTables configuration object.</p>

          <h2 data-anchor="Setting-options"><a name="Setting-options"></a>Setting options</h2>

          <p>Configuration of DataTables is done by passing the options you want defined into the DataTables constructor as an object. For example:</p>

          <pre><code class="multiline language-js">$('#example').DataTable( {
    paging: false
} );
</code></pre>

          <p>This uses the <a href="//datatables.net/reference/option/paging"><code class="option" title="DataTables initialisation option">paging</code></a> option to disable paging for the table.</p>

          <p>Let's say you want to enable scrolling in the table - you would use the <a href="//datatables.net/reference/option/scrollY"><code class="option" title="DataTables initialisation option">scrollY</code></a> option:</p>

          <pre><code class="multiline language-js">$('#example').DataTable( {
    scrollY: 400
} );
</code></pre>

          <p>Extending that, you can combine multiple options into a single object. In this case we enable scrolling and disable paging:</p>

          <pre><code class="multiline language-js">$('#example').DataTable( {
    paging: false,
    scrollY: 400
} );
</code></pre>

          <p>The object being passed in is just a standard Javascript object and can be treated as such. Add as many options as you wish!</p>

          <p>For the full range of configuration options available for DataTables, please refer to the <a href="/reference/option">options reference</a> section of this web-site.</p>

          <h3 data-anchor="HTML-5-data-attributes"><a name="HTML-5-data-attributes"></a>HTML 5 data attributes</h3>

          <p>As of <span class="since">v1.10.5</span> DataTables can also use initialisation options read from HTML5 <code>data-*</code> attributes. This provides a mechanism for setting options directly in your HTML, rather than using Javascript (as above). Consider for example the following table:</p>

          <pre><code class="multiline language-html">&lt;table data-order='[[ 1, "asc" ]]' data-page-length='25'&gt;
    &lt;thead&gt;
        &lt;tr&gt;
            &lt;th&gt;Name&lt;/th&gt;
            &lt;th&gt;Position&lt;/th&gt;
            &lt;th&gt;Office&lt;/th&gt;
            &lt;th&gt;Age&lt;/th&gt;
            &lt;th&gt;Start date&lt;/th&gt;
            &lt;th data-class-name="priority"&gt;Salary&lt;/th&gt;
        &lt;/tr&gt;
    &lt;/thead&gt;
&lt;/table&gt;
</code></pre>

          <p>When DataTables is initialised on this table it will set <a href="//datatables.net/reference/option/pageLength"><code class="option" title="DataTables initialisation option">pageLength</code></a> to 25, order by the second column automatically (<a href="//datatables.net/reference/option/order"><code class="option" title="DataTables initialisation option">order</code></a>) and set a class name on the final column of the table (<a href="//datatables.net/reference/option/columns.className"><code class="option" title="DataTables initialisation option">columns.className</code></a>).</p>

          <p>There are two important points to consider when using <code>data-*</code> attributes as initialisation options:</p>

          <ul class="markdown">
            <li>jQuery will automatically convert from dashed strings to the camel case notation used by DataTables (e.g. use <code>data-page-length</code> for <a href="//datatables.net/reference/option/pageLength"><code class="option" title="DataTables initialisation option">pageLength</code></a>).</li>
            <li>If using a string inside the attribute it <strong>must</strong> be in double quotes (and therefore the attribute as a whole in single quotes). This is another requirement of jQuery's due to the processing of JSON data.</li>
          </ul>

          <h2 data-anchor="Common-options"><a name="Common-options"></a>Common options</h2>

          <p>Some of the options you might find particularly useful are:</p>

          <ul class="markdown">
            <li><a href="//datatables.net/reference/option/ajax"><code class="option" title="DataTables initialisation option">ajax</code></a> - Ajax data source configuration</li>
            <li><a href="//datatables.net/reference/option/data"><code class="option" title="DataTables initialisation option">data</code></a> - Javascript sourced data</li>
            <li><a href="//datatables.net/reference/option/serverSide"><code class="option" title="DataTables initialisation option">serverSide</code></a> - Enable server-side processing</li>
            <li><a href="//datatables.net/reference/option/columns.data"><code class="option" title="DataTables initialisation option">columns.data</code></a> - Data source options for a column</li>
            <li><a href="//datatables.net/reference/option/scrollX"><code class="option" title="DataTables initialisation option">scrollX</code></a> - Horizontal scrolling</li>
            <li><a href="//datatables.net/reference/option/scrollY"><code class="option" title="DataTables initialisation option">scrollY</code></a> - Vertical scrolling</li>
            <li><a href="/reference/option">Full list of options</a></li>
          </ul>

          <h2 data-anchor="Setting-defaults"><a name="Setting-defaults"></a>Setting defaults</h2>

          <p>When on projects that use multiple DataTables it is often useful to set the initialisation defaults to common values (for example you might want to set the <a href="//datatables.net/reference/option/dom"><code class="option" title="DataTables initialisation option">dom</code></a> option to a common value so all tables get the same layout). This can be done using the <code>$.fn.dataTable.defaults</code> object. This object takes all of the same parameters as the DataTables initialisation object, but in this case you are setting the default for all future initialisations of DataTables.</p>

          <p>In this example we disable the searching and ordering features of DataTables by default, but when the table is initialised, it is initialised with ordering enabled (overriding the default).</p>

          <pre><code class="multiline language-js">// Disable search and ordering by default
$.extend( $.fn.dataTable.defaults, {
    searching: false,
    ordering:  false
} );

// For this specific table we are going to enable ordering
// (searching is still disabled)
$('#example').DataTable( {
    ordering: true
} );
</code></pre>

          <h2 data-anchor="Extensions"><a name="Extensions"></a>Extensions</h2>

          <p>Many of DataTables <a href="/extensions">extensions</a> can also be configured through the DataTables configuration object, initialising the extension and configuring it as required. The properties available depend upon the extensions used, and the extension Javascript must be loaded in order for those options to operate.</p>

          <p>For example, consider the <a href="/extensions/select">Select extension</a> which provides the end user with the ability to dynamically select rows, columns and cells in the table. It presents the <a href="//datatables.net/reference/option/select"><code class="option" title="Select initialisation option">select</code></a> option which can be set to <code>true</code> to enable selection:</p>

          <pre><code class="multiline language-js">$('#myTable').DataTable( {
    select: true
} );
</code></pre>

          <p>The <a href="//datatables.net/reference/option/select"><code class="option" title="Select initialisation option">select</code></a> option can also be given as an object to give fine grained control over the selection options and of course can be combined with the other DataTables options.</p>

          <p>The <a href="/reference/option">options reference</a> provides a searchable list of all options from DataTables and the extensions.</p>

        </div>
      </div>

      <div class="fw-page-nav">
        <div class="page-nav">
          <div class="page-nav-title">Page navigation</div>
        </div>
      </div>
    </div>

    <div class="fw-footer">
      <div class="skew"></div>
      <div class="skew-bg"></div>
      <div class="copyright">
        <h4>DataTables</h4>
        <p>
          DataTables designed and created by <a href="//sprymedia.co.uk">SpryMedia Ltd</a>.<br>
          &copy; 2007-2018 <a href="/license/mit">MIT licensed</a>. Our <a href="/supporters">Supporters</a>.<br>
          SpryMedia Ltd is registered in Scotland, company no. SC456502.
        </p>
      </div>
    </div>


    <div id="popup" name="popup" style="display: none;">
      <span class="button b-close"><span>X</span></span>
      <div class="content">IGOR KOS</div>
    </div>

    <script>
      $('#popup').bPopup({
        contentContainer: '.content',
        loadUrl: 'test.html'
      });
    </script>
  </body>
</html>
