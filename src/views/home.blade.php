<!DOCTYPE html>
<html>
    <head>
        <title>FontAwesomePHP</title>
        <meta charset="utf-8">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet" />
        <link href="//netdna.bootstrapcdn.com/bootswatch/3.0.0/flatly/bootstrap.min.css" rel="stylesheet" />
        {{ FA::css() }}
        <style type="text/css" rel="stylesheet">
            #wrap {
                padding-top: 100px;
            }
            #forkMe {
                position: fixed;
                top: 0;
                right: 0;
                border: 0;
                z-index: 1000;
            }
            em {
                color:#65B042;
            }
            strong {
                color:#E28964;
            }
            .inline {
                display:inline;
            }
            .note {
                color:#7b8a8b;
                font-size:10pt;
            }
            .anchor {
                position: reletive;
                top: -50px;
            }
            .underline {
                border-bottom:2px solid #2c3e50;
                margin-bottom: 5px;
            }
            .example p {
                float:left;
            }
            .example pre {
                margin-left: 50px;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/fontawesome">FontAwesomePHP</a>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#install">
                            {{ FA::fixedWidth('magic') }} Install
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#usage">
                            {{ FA::fixedWidth('flash') }} Usage
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#api">
                            {{ FA::fixedWidth('cogs') }} Api
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#examples">
                            {{ FA::fixedWidth('book') }} Examples
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#">
                            {{ FA::fixedWidth('download') }} Download v1.0b
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <a href="https://github.com/kevinkhill/LavaCharts" id="forkMe">
            <img src="/packages/khill/fontawesome/images/forkme.png" alt="Fork me on GitHub">
        </a>

        <div class="container" id="wrap">
            <div class="jumbotron">
                <h1>Font Awesome for PHP</h1>
                <p>A composer ready package designed to integrate the fantastic <a href="http://fontawesome.io/">Font Awesome</a> icon set into your PHP project.</p>
                <p>Created with Laravel in mind, a ServiceProvider and Facade have been included as well.</p>
            </div>

            <br /><br />

            <a class="anchor" name="install">&nbsp;</a>
            <div class="underline">
                <h1>Installation</h1>
            </div>
                <ul class="nav nav-pills">
                    <li class="active"><a href="#composer-install" data-toggle="tab">Composer / Laravel</a></li>
                    <li><a href="#manual-install" data-toggle="tab">Manual</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="composer-install">
                        <h1><small>With Composer</small></h1>
                        <h4>First, add the package to your main composer.json file:</h4>
                        <pre class="prettyprint">"Khill\Fontawesome" : "dev-master"</pre>

                        <h4>Next, run composer from the command line to download and install:</h4>
                        <pre class="prettyprint">composer install</pre>

                        <h4>Then, if you are using Laravel, add the ServiceProvider to the service providers array in the app.php file:</h4>
                        <p>Skip this step if you are not using Laravel</p>
                        <pre class="prettyprint">'Khill\Fontawesome\FontAwesomeServiceProvider'</pre>

                        <h4>Last, add the link in your view's page header to the FontAwesome CSS file, provided by <a href="http://www.bootstrapcdn.com/">BootstrapCDN</a>:</h4>
                        <pre class="prettyprint">FontAwesome::css() // Or FA:css() if you want to use the alias</pre>
                    </div>
                    <div class="tab-pane fade" id="manual-install">
                        <h1><small>Manually</small></h1>
                        <h4>First, Download the zip file from above and extract the src folder into your project. Then, include the main class and you're good to go!</h4>
                        <pre class="prettyprint">include("src/Khill/FontAwesome.php");</pre>
                        <h4>Next, Copy the assets (css & fonts) from the library's public folder to your project's assets folder to include them manually:</h4>
                        <pre class="prettyprint">assets/css/bootstrap.min.css
assets/fonts/fontawesome-webfont.eot
assets/fonts/fontawesome-webfont.svg
assets/fonts/fontawesome-webfont.ttf
assets/fonts/fontawesome-webfont.wof
assets/fonts/FontAwesome.otf</pre>
                    <h4>Last, add the link to the Font Awesome CSS file in your page header:</h4>
                    <pre class="prettyprint">&lt;link href="[ASSET_DIR]/css/bootstrap.min.css" rel="stylesheet" /&gt;</pre>
                    </div>
                </div><!--/install tabs-->


            <br /><br /><br />

            <a name="usage"></a>
            <div class="underline">
                <h1>Usage</h1>
            </div>
                <ul class="nav nav-pills">
                    <li class="active"><a href="#laravel-usage" data-toggle="tab">Laravel</a></li>
                    <li><a href="#generic-usage" data-toggle="tab">Generic</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="laravel-usage">
                        <h1><small>The Laravel Way</small></h1>
                        <h4>Since we love Laravel, and making life easy, we took care of aliasing the library with a facade, so calls are simple:</h4>
                        {{ FA::icon('star') }}<pre class="prettyprint">echo FA::icon('star');</pre>
                    </div>
                    <div class="tab-pane fade in" id="generic-usage">
                        <h1><small>Generic PHP</small></h1>
                        <h4>If you are using this library in a different framework, then create a new instance of FontAwesome, and call from the object:</h4>
                {{ FA::icon('star') }}<pre class="prettyprint">$fa = new FontAwesome;
echo $fa->icon('star');</pre>
                    </div>
                </div>

            <br /><br /><br />

            <a name="api">&nbsp;</a>
            <div class="underline">
                <h1>Api</h1>
            </div>
                <h4>All of the methods of the API correspond with how Font Awesome  is used, to make FontAwesomePHP intuitive and easy to use. We've also thrown in a few extra features.</h4><br />

                <h3>Inline Icons:</h3>
                <h4>Add icons anywhere with this simple syntax.</h4>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        {{ FA::icon('home') }} icon('home');
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <pre>icon($iconLabel);</pre>
                        <h4><strong>param</strong> $iconLabel <em>string</em> The name of the icon to display <span class="note">(omit the prefix "fa-")</span></h4>
                        <h4><strong>returns</strong> <em>string</em> Icon HTML</h4>
                    </div>
                </div><br />

                <h3>Sizing Icons:</h3>
                <h4>Increase an icon's size with the following methods.</h4>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        {{ FA::lg('rocket') }} lg('rocket');<br />
                        {{ FA::x2('rocket') }} x2('rocket');<br />
                        {{ FA::x3('rocket') }} x3('rocket');<br />
                        {{ FA::x4('rocket') }} x4('rocket');<br />
                        {{ FA::x5('rocket') }} x5('rocket');
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <pre>lg($iconLabel);
x2($iconLabel);
x3($iconLabel);
x4($iconLabel);
x5($iconLabel);
</pre>
                        <h4><strong>param</strong> $iconLabel <em>string</em> The name of the icon to display <span class="note">(omit the prefix "fa-")</span></h4>
                        <h4><strong>returns</strong> <em>string</em> Icon HTML</h4>
                    </div>
                </div><br />

                <h3>Fixed Width Icons:</h3>
                <h4>Set icons to have a fixed width, perfect for menus or buttons.</h4>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="#"><i class="fa fa-home fa-fw"></i> Home</a></li>
                            <li><a href="#"><i class="fa fa-flask fa-fw"></i> Science</a></li>
                            <li><a href="#"><i class="fa fa-group fa-fw"></i> Connect</a></li>
                            <li><a href="#"><i class="fa fa-upload fa-fw"></i> Upload</a></li>
                        </ul>
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <pre>fixedWidth($iconLabel);</pre>
                        <h4><strong>param</strong> $iconLabel <em>string</em> The name of the icon to display <span class="note">(omit the prefix "fa-")</span></h4>
                        <h4><strong>returns</strong> <em>string</em> Icon HTML</h4>
                        <p>Example: <span class="note">(Laravel alias within blade template shown) </span></p>
                        <pre>&lt;ul class="nav nav-pills nav-stacked"&gt;
    &lt;li class="active"&gt;&lt;a href="#"&gt;&#123;&#123; FA::fixedWidth('home') &#125;&#125; Home&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href="#"&gt;&#123;&#123; FA::fixedWidth('flask') &#125;&#125; Science&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href="#"&gt;&#123;&#123; FA::fixedWidth('group') &#125;&#125; Connect&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href="#"&gt;&#123;&#123; FA::fixedWidth('upload') &#125;&#125; Upload&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;</pre>
                    </div>
                </div><br />

                <h3>List Icons:</h3>
                <h4></h4>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                    </div>
                    <div class="col-md-9 col-sm-8">
                    </div>
                </div><br />

                <h3>Bordered & Pulled Icons:</h3>
                <h4></h4>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                    </div>
                    <div class="col-md-9 col-sm-8">
                    </div>
                </div><br />

                <h3>Spinning Icons:</h3>
                <h4></h4>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                    </div>
                    <div class="col-md-9 col-sm-8">
                    </div>
                </div><br />

                <h3>Rotated & Flipped Icons:</h3>
                <h4></h4>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                    </div>
                    <div class="col-md-9 col-sm-8">
                    </div>
                </div><br />

                <h3>Stacked Icons:</h3>
                <h4></h4>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                    </div>
                    <div class="col-md-9 col-sm-8">
                    </div>
                </div><br />

                <h3>Chaining</h3>
                <h4>The methods can be chained together to create dynamic icons</h4>
                <div class="example">
                    <p class="icon">{{ FA::icon('shopping-cart')->flipVertical()->x3() }}</p>
                    <pre class="prettyprint">icon('shopping-cart')->flipVertical()->x3();</pre>
                </div>
                <div class="example">
                    <p class="icon">{{ FA::icon('cutlery')->rotate270()->x5() }}</p>
                    <pre class="prettyprint">icon('cutlery')->rotate270()->x5();</pre>
                </div>
                <div class="example">
                    <p class="icon" style="background-color:#ccc;">{{ FA::icon('truck')->inverse()->x4() }}</p>
                    <pre class="prettyprint">icon('truck')->inverse()->x4();</pre>
                    <p>(the grey background is just so you can see the inverse effect)</p>
                </div>

<div style="clear:both;"></div>

                <h3>Stacks</h3>
                <h4>Stacking icons is simple, chain the methods together following the syntax below</h4>
                <pre class="prettyprint">stack('ban')->on('scissors');</pre>
                <p class="icon">{{ FA::stack('ban')->on('scissors') }}</p>
                <h4>You can also chain modification methods inbetween to make fancy stacks</h4>
                <pre class="prettyprint">stack('ban')->x3()->on('scissors')->inverse();</pre>
                <p class="icon">{{ FA::stack('ban')->x3()->on('scissors')->inverse() }}</p>

                <h3>Collection</h3>
                <h4>Icons can be stored into a collection to later be recalled from within a view.</h4>
                <pre class="prettyprint">icon('cog')->store('savedIcon1'); //Store Icons
echo collection('savedIcon1'); //Retrieve within template or HTML</pre>
                <p class="icon">{{ FA::icon('cog') }}</p>
            </div>

            <a name="examples">&nbsp;</a>
            <div class="underline">
                <h1>Examples</h1>
            </div>
            <ul class="nav nav-pills">
                <li class="active"><a href="#laravel-examples" data-toggle="tab">Laravel</a></li>
                <li><a href="#generic-examples" data-toggle="tab">Generic</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="laravel-examples">
                    <h4>Here are some examples of how to use the library in your applications.</h4>

                    <h3>Simple Icons</h3>

                    <h3>Chaining</h3>
                    <h4>The methods can be chained together to create dynamic icons</h4>
                    <div class="example">
                        <p class="icon">{{ FA::icon('shopping-cart')->flipVertical()->x3() }}</p>
                        <pre class="prettyprint">icon('shopping-cart')->flipVertical()->x3();</pre>
                    </div>
                    <div class="example">
                        <p class="icon">{{ FA::icon('cutlery')->rotate270()->x5() }}</p>
                        <pre class="prettyprint">icon('cutlery')->rotate270()->x5();</pre>
                    </div>
                    <div class="example">
                        <p class="icon" style="background-color:#ccc;">{{ FA::icon('truck')->inverse()->x4() }}</p>
                        <pre class="prettyprint">icon('truck')->inverse()->x4();</pre>
                        <p>(the grey background is just so you can see the inverse effect)</p>
                    </div>
    <div style="clear:both;"></div>
                    <h3>Stacks</h3>
                    <h4>Stacking icons is simple, chain the methods together following the syntax below</h4>
                    <pre class="prettyprint">stack('ban')->on('scissors');</pre>
                    <p class="icon">{{ FA::stack('ban')->on('scissors') }}</p>
                    <h4>You can also chain modification methods inbetween to make fancy stacks</h4>
                    <pre class="prettyprint">stack('ban')->x3()->on('scissors')->inverse();</pre>
                    <p class="icon">{{ FA::stack('ban')->x3()->on('scissors')->inverse() }}</p>

                    <h3>Collection</h3>
                    <h4>Icons can be stored into a collection to later be recalled from within a view.</h4>
                    <pre class="prettyprint">icon('cog')->store('savedIcon1'); //Store Icons
echo collection('savedIcon1'); //Retrieve within template or HTML</pre>
                    <p class="icon">{{ FA::icon('cog') }}</p>
                </div>
                <div class="tab-pane fade in" id="generic-examples">
                </div>
            </div>
        </div><!--/container-->
    </body>
</html>
