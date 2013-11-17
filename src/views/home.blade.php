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
                z-index: 9999;
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
                        <a href="#examples">
                            {{ FA::fixedWidth('book') }} Examples
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="">
                            {{ FA::fixedWidth('cogs') }} Api
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

        <a href="https://github.com/kevinkhill/FontAwesomePHP" id="forkMe">
            <img alt="Fork me on GitHub" src="data:image/png;base64,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" />
        </a>

        <div class="container" id="wrap">
            <div class="jumbotron">
                <h1>Font Awesome for PHP</h1>
                <p>{{ FA::icon('plane') }} A composer ready package designed to integrate the fantastic <a href="http://fontawesome.io/">Font Awesome</a> icon set into your PHP projects through an easy to use interface.</p>
                <p>Created with Laravel in mind, a ServiceProvider and Facade have been included as well. {{ FA::icon('thumbs-up') }}</p>
                <p>{{ FA::icon('smile-o') }} Don't worry though, the library will work in any PHP application, via composer or manually.</p>
            </div>

            <a class="anchor" name="install">&nbsp;</a>
            <br /><br />
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
                        <pre class="prettyprint">FontAwesome::css() // Or FA::css() if you want to use the alias</pre>
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


            <a name="usage">&nbsp;</a>
            <br /><br />
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
                        <pre class="prettyprint">echo FA::icon('star');</pre>
                        <p>will output the icon html for you</p>
                        <pre class="prettyprint">&lt;i class="fa fa-star"&gt;&lt;/i&gt;</pre>
                    </div>
                    <div class="tab-pane fade in" id="generic-usage">
                        <h1><small>Generic PHP</small></h1>
                        <h4>If you are using this library in a different framework, then create a new instance of FontAwesome, and call from the object:</h4>
                        <pre class="prettyprint">$fa = new FontAwesome;
echo $fa->icon('star');</pre>
                        <p>will output the icon html for you</p>
                        <pre class="prettyprint">&lt;i class="fa fa-star"&gt;&lt;/i&gt;</pre>
                    </div>
                </div>


            <a name="examples">&nbsp;</a>
            <br /><br />
            <div class="underline">
                <h1>Examples</h1>
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
                        {{ FA::border('github') }} border('github')<br />
                        {{ FA::left('camera') }} left('camera')<br />
                        {{ FA::right('cloud') }} right('cloud')<br />
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <pre>border('github');
left('camera');
right('cloud');
</pre>
                        <h4><strong>param</strong> $iconLabel <em>string</em> The name of the icon to display <span class="note">(omit the prefix "fa-")</span></h4>
                        <h4><strong>returns</strong> <em>string</em> Icon HTML</h4>
                    </div>
                </div><br />

                <h3>Spinning Icons:</h3>
                <h4>Animate any icon to spin with this method.</h4>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        {{ FA::spin('question-circle') }} spin('question-circle')
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <pre>spin('question-circle')</pre>
                        <h4><strong>param</strong> $iconLabel <em>string</em> The name of the icon to display <span class="note">(omit the prefix "fa-")</span></h4>
                        <h4><strong>returns</strong> <em>string</em> Icon HTML</h4>
                    </div>
                </div><br />

                <h3>Rotated & Flipped Icons:</h3>
                <h4>Any icon can be flipped and rotated with these following methods.</h4>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        {{ FA::rotate90('pencil') }} rotate90('pencil')<br />
                        {{ FA::rotate180('leaf') }} rotate180('leaf')<br />
                        {{ FA::rotate270('gamepad') }} rotate270('gamepad')<br />
                        {{ FA::flipHorizontal('signal') }} flipHorizontal('signal')<br />
                        {{ FA::flipVertical('tags') }} flipVertical('tags')
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <pre>rotate90('pencil');
rotate180('leaf');
rotate270('gamepad');
flipHorizontal('signal');
flipVertical('tags');</pre>
                        <h4><strong>param</strong> $iconLabel <em>string</em> The name of the icon to display <span class="note">(omit the prefix "fa-")</span></h4>
                        <h4><strong>returns</strong> <em>string</em> Icon HTML</h4>
                    </div>
                </div><br />

                <h3>Stacked Icons:</h3>
                <h4>Stacking icons is simple, just chain the methods together using the following syntax.</h4>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        {{ FA::stack('ban')->on('comments') }}<br />
                        {{ FA::stack('square-o')->on('fighter-jet') }}<br />
                        {{ FA::stack('twitter')->on('circle-o') }}<br />
<span class="fa-stack fa-4x">
<i class="fa fa-square-o fa-stack-2x"></i>
<i class="fa fa-fighter-jet fa-stack-1x"></i>
</span>
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <pre>stack('ban')->on('comments');</pre>
                        <h5>You can also chain on size modification methods</h5>
                        <pre>stack('fighter-jet')->on('square-o')->lg();
stack('twitter')->on('circle-o')->x3();</pre>
                        <h4><strong>param</strong> $iconLabel <em>string</em> The name of the icon to display <span class="note">(omit the prefix "fa-")</span></h4>
                        <h4><strong>returns</strong> <em>string</em> Icon HTML</h4>
                    </div>
                </div><br />

                <h3>Chaining</h3>
                <h4>The methods can be chained together to create dynamic icons</h4>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        {{ FA::x3('shopping-cart')->flipVertical() }}<br />
                        {{ FA::rotate270('cutlery')->x3() }}<br />
                        <div style="background-color:#bbb;padding:5px;width:80px;">{{ FA::icon('truck')->x4()->inverse() }}</div>
                        {{ FA::right('gavel')->border()->x2() }}
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <pre>x3('shopping-cart')->flipVertical();</pre>
                        <pre>rotate270('cutlery')->x3();</pre>
                        <pre>icon('truck')->x4()->inverse();
//the grey background is just so you can see the inverse effect</pre>
                        <pre>right('gavel')->border()->x2();</pre>
                        <h4><strong>returns</strong> <em>FontAwesome</em> All of the methods return the FontAwesome object so that they can be chained together. The magic method __toString() will output the HTML once you echo or print the object.</h4>
                    </div>
                </div><br />

                <h3>Collection</h3>
                <h4>Icons can be stored into a collection to later be recalled from within a view.</h4>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        {{ FA::x3('cog') }}
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <pre>x3('cog')->store('savedIcon1'); //Store Icons
echo collection('savedIcon1'); //Retrieve within template or HTML</pre>
                    </div>
                </div><br />

        </div><!--/container-->
    </body>
</html>
