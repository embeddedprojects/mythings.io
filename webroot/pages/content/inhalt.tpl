
<style type="text/css">
    .yui-carousel-element li {
        height: 158px;
        text-align: left;
    }

    #container {
        font-size: 13px;
        margin: 0 auto;
    }

    #container a {
        text-decoration: none;
    }
            
    #container .intro {
        display: inline;
        margin: 0px 14px 0px 4px;
        width: 230px;
    }
            
    #container .item {
        display: inline;
        margin: 0 22px 0 12px;
        overflow: hidden;
        padding-right: 80px;
        width: 106px;
    }

    #container .item .authimg {
        bottom: 2px;
        margin-left: 61px;
        position: absolute;
        z-index: 1;
    }
            
    #container .item h3 {
        line-height: 85%;
        margin-top: 4px;
    }
            
    #container .item h3 a {
        font: 77% Arial, sans-serif;
        position: relative;
        text-transform: uppercase;
        z-index: 2;
    }
            
    #container .item h3 a:link {
        color:#35a235;
    }
            
    #container .item h4 {
        margin-top:5px;
    }
            
    #container .item h4 a {
        font: 100% Georgia, Times, serif;
        position: relative;
        z-index:2;
    }

    #container .item h4 a:link {
        color:#00639b;
    }
            
    #container .item cite {
        color: #888;
        display: block;
        font-size: 77%;
        line-height: normal;
        margin-bottom: 30px;
    }
            
    #container .item p.all {
        bottom: 25px;
        position: absolute;
        z-index: 2;
    }
            
    #container .item p.all a {
        font-weight: bold;
        font-size: 85%;
    }
</style>


<h3>JTAG Programmer und Debugger</h3>
<h2> <span class="mw-headline" id="Motivation_und_Entwicklung">Motivation und Entwicklung</span>  <span style="font-size: x-small; font-weight: normal; float: none; margin-left: 0px;" class="editsection">[<a href="/w/index.php?title=Joint_Test_Action_Group&amp;action=edit&amp;section=1" title="Abschnitt bearbeiten: Motivation und Entwicklung">Bearbeiten</a>]</span></h2>

<p>Ende der 1970er Jahre war der Integrationsgrad der Mikroelektronik soweit gestiegen (zeitgenössische komplexe IC sind <a href="/wiki/Intel_4004" title="Intel 4004">Intel 4004</a>, <a href="/wiki/Intel_8008" title="Intel 8008">Intel 8008</a> oder Zilog <a href="/wiki/Z80" title="Z80" class="mw-redirect">Z80</a>), dass ICs mit tausenden <a href="/wiki/Flipflop" title="Flipflop">Flipflops</a> bzw. Registern in einem IC arbeiteten. Die Zustände dieser internen Flipflops sind bei einem IC nicht mehr zugänglich. Es entstand die Forderung (zunächst der IC-Hersteller selbst), dass zum Test der Struktur eines komplexen IC dessen Gatter und Leitungen steuerbar; zum Test der Funktion die Zustände (aller Register und Flipflops) beobachtbar sein sollten. Eichelberger veröffentlichte 1977<sup id="cite_ref-0" class="reference"><a href="#cite_note-0">[1]</a></sup> einen als <a href="/wiki/Boundary_Scan_Test" title="Boundary Scan Test">Scan-Path</a> bezeichneten Lösungsansatz, bei dem jedes Flipflop im IC einen zusätzlichen Multiplexer (Transfergate) am Eingang erhält. Auf diese Weise können nun alle Flipflops des IC wahlweise zu einem langen <a href="/wiki/Schieberegister" title="Schieberegister">Schieberegister</a> zusammengeschaltet werden, über das jeder Zustand jedes Flipflops von außen beobachtbar und steuerbar wird.</p>

<p>Der JTAG-Standard entstand durch einen Zusammenschluss von <a href="/wiki/Halbleiterhersteller" title="Halbleiterhersteller">Halbleiterherstellern</a> im Jahr 1985/86. Es wurde ein Standard erarbeitet, der in der Norm IEEE 1149.1-1990 festgehalten wurde. Mit der Überarbeitung IEEE 1149.1-1994 ist die <a href="/wiki/Boundary_Scan_Description_Language" title="Boundary Scan Description Language">Boundary Scan Description Language</a> Teil des Standards. Die aktuelle Version des Standards ist <i>1149.1-2001 IEEE standard test access port and boundary-scan architecture</i>.<sup id="cite_ref-1" class="reference"><a href="#cite_note-1">[2]</a></sup></p>
<h2> <span class="mw-headline" id="Funktionsweise">Funktionsweise</span>  <span style="font-size: x-small; font-weight: normal; float: none; margin-left: 0px;" class="editsection">[<a href="/w/index.php?title=Joint_Test_Action_Group&amp;action=edit&amp;section=2" title="Abschnitt bearbeiten: Funktionsweise">Bearbeiten</a>]</span></h2>

<h3> <span class="mw-headline" id="Aufbau">Aufbau</span>  <span style="font-size: x-small; font-weight: normal; float: none; margin-left: 0px;" class="editsection">[<a href="/w/index.php?title=Joint_Test_Action_Group&amp;action=edit&amp;section=3" title="Abschnitt bearbeiten: Aufbau">Bearbeiten</a>]</span></h3>
<p>Eine JTAG-Komponente besteht im wesentlichen aus folgenden Teilen:</p>
<ul>
<li>Dem <i>Test Access Port</i> (TAP) mit den Steuerleitungen, im allgemeinen auch <i>JTAG-Port</i> oder <i>JTAG-Schnittstelle</i> genannt.</li>

<li>Dem <i>TAP-Controller</i>, eine <a href="/wiki/Endlicher_Automat" title="Endlicher Automat">State-Machine</a>, welche die Testlogik steuert.</li>
<li>Zwei Schieberegistern, dem „Instruction Register“ (IR) und dem „Data Register“ (DR).</li>
</ul>

<br>
<!-- The Carousel container -->
<div id="container">
    <ol id="carousel">
        <li class="intro">
            <a href="http://health.yahoo.com/experts/">
                <img width="202" height="162" border="0"
                     alt="Health Expert Advice: Leading experts share advice, tips and personal experiences."
                     src="http://l.yimg.com/a/i/us/he/gr/v4/carouselintro.png"/>
            </a>
        </li>
        <li class="item">
            <a title="View Author's Biography" class="authimg"
               href="http://health.yahoo.com/experts/skintype/bio/leslie-baumann/">

                <img width="125" height="154" border="0"
                     alt="Leslie Baumann, M.D."
                     src="http://l.yimg.com/fz/ls/he/blogs/carousel/LeslieBaumann_carousel.png"/>
            </a>
            <h3><a href="http://health.yahoo.com/experts/skintype/bio/leslie-baumann/">Leslie Baumann, M.D.</a></h3>
            <h4><a href="http://health.yahoo.com/experts/skintype/12135/skin-treatments-for-brides-to-be/">
            Skin Treatments for…</a></h4>
            <cite>Posted Thu 5.1.08</cite>
            <p class="all"><a href="http://health.yahoo.com/experts/skintype/">View All Posts &raquo;</a></p>

        </li>
        <li class="item">
            <a title="View Author's Biography" class="authimg"
               href="http://health.yahoo.com/experts/deepak/bio/deepak-chopra/">
                <img width="125" height="154" border="0"
                     alt="Deepak Chopra, M.D."
                     src="http://l.yimg.com/fz/ls/he/blogs/carousel/DeepakChopra_carousel.png"/>
            </a>
            <h3><a href="http://health.yahoo.com/experts/deepak/bio/deepak-chopra/">Deepak Chopra, M.D.</a></h3>
            <h4><a href="http://health.yahoo.com/experts/deepak/2689/how-you-think-about-illness-affects-your-recovery/">
            How You Think About Illness…</a></h4>

            <cite>Posted Thu 5.1.08</cite>
            <p class="all"><a href="http://health.yahoo.com/experts/deepak/">View All Posts &raquo;</a></p>
        </li>
        <li class="item">
            <a title="View Author's Biography" class="authimg"
               href="http://health.yahoo.com/experts/nutrition/bio/christine-mckinney-nutrition/">
                <img width="125" height="154" border="0" class="lz"
                     alt="Christine McKinney, M.S., R.D., C.D.E."
                     src="http://l.yimg.com/fz/ls/he/blogs/carousel/ChristineMcKinney_carousel.png"/>
            </a>
            <h3><a href="http://health.yahoo.com/experts/nutrition/bio/christine-mckinney-nutrition/">

            Christine McKinney, M.S., R.D., C.D.E.</a></h3>
            <h4><a href="http://health.yahoo.com/experts/nutrition/12067/fat-how-much-is-enough-of-a-good-thing/">
            Fat: How Much Is Enough of a…</a></h4>
            <cite>Posted Thu 5.1.08</cite>
            <p class="all"><a href="http://health.yahoo.com/experts/nutrition/">View All Posts &raquo;</a></p>
        </li>
        <li class="item">

            <a title="View Author's Biography" class="authimg"
               href="http://health.yahoo.com/experts/drmao/bio/maoshing-ni/">
                <img width="125" height="154" border="0" class="lz"
                     alt="Dr. Maoshing Ni"
                     src="http://l.yimg.com/fz/ls/he/blogs/carousel/MaoshingNi_carousel.png"/>
            </a>
            <h3><a href="http://health.yahoo.com/experts/drmao/bio/maoshing-ni/">Dr. Maoshing Ni</a></h3>
            <h4><a href="http://health.yahoo.com/experts/drmao/13738/centenarian-tips-for-a-long-life/">
            Centenarian Tips for a Long…</a></h4>
            <cite>Posted Tue 4.29.08</cite>

            <p class="all"><a href="http://health.yahoo.com/experts/drmao/">View All Posts &raquo;</a></p>
        </li>
        <li class="item">
            <a title="View Author's Biography" class="authimg"
               href="http://health.yahoo.com/experts/breastcancer/bio/lillie-shockney/">
                <img width="125" height="154" border="0" class="lz"
                     alt="Lillie Shockney, R.N., M.A.S."
                     src="http://l.yimg.com/fz/ls/he/blogs/carousel/LillieShockney_carousel.png"/>
            </a>
            <h3><a href="http://health.yahoo.com/experts/breastcancer/bio/lillie-shockney/">
            Lillie Shockney, R.N., M.A.S.</a></h3>

            <h4><a href="http://health.yahoo.com/experts/breastcancer/5673/are-you-being-over-or-undertreated/">
            Are You Being Over- or…</a></h4>
            <cite>Posted Tue 4.29.08</cite>
            <p class="all"><a href="http://health.yahoo.com/experts/breastcancer/">View All Posts &raquo;</a></p>
        </li>
        <li class="item">
            <a title="View Author's Biography" class="authimg"
               href="http://health.yahoo.com/experts/depression/bio/david-neubauer/">

                <img width="125" height="154" border="0" class="lz"
                     alt="David Neubauer, M.D."
                     src="http://l.yimg.com/fz/ls/he/blogs/carousel/DavidNeubauer_carousel.png"/>
            </a>
            <h3><a href="http://health.yahoo.com/experts/depression/bio/david-neubauer/">David Neubauer, M.D.</a></h3>
            <h4><a href="http://health.yahoo.com/experts/depression/12445/could-a-breast-cancer-treatment-help-bipolar-disorder/">
            Could a Breast Cancer…</a></h4>
            <cite>Posted Tue 4.29.08</cite>
            <p class="all"><a href="http://health.yahoo.com/experts/depression/">View All Posts &raquo;</a></p>

        </li>
        <li class="item">
            <a title="View Author's Biography" class="authimg"
               href="http://health.yahoo.com/experts/capessa/bio/capessa/">
                <img width="125" height="154" border="0" class="lz"
                     alt="Jennifer Tuma-Young"
                     src="http://l.yimg.com/fz/ls/he/blogs/carousel/Capessa_carousel.png"/>
            </a>
            <h3><a href="http://health.yahoo.com/experts/capessa/bio/capessa/">Jennifer Tuma-Young</a></h3>
            <h4><a href="http://health.yahoo.com/experts/capessa/3473/relieve-stress-with-your-senses/">
            Relieve Stress With Your…</a></h4>

            <cite>Posted Mon 4.28.08</cite>
            <p class="all"><a href="http://health.yahoo.com/experts/capessa/">View All Posts &raquo;</a></p>
        </li>
        <li class="item">
            <a title="View Author's Biography" class="authimg"
               href="http://health.yahoo.com/experts/healthieryou/bio/lucydanziger/">
                <img width="125" height="154" border="0" class="lz"
                     alt="Lucy Danziger, SELF Edit"
                     src="http://l.yimg.com/fz/ls/he/blogs/carousel/LucyDanziger_carousel.png"/>
            </a>
            <h3><a href="http://health.yahoo.com/experts/healthieryou/bio/lucydanziger/">Lucy Danziger, SELF Edit</a></h3>

            <h4><a href="http://health.yahoo.com/experts/healthieryou/2639/de-stress-in-mere-minutes/">
            De-Stress in Mere Minutes</a></h4>
            <cite>Posted Mon 4.28.08</cite>
            <p class="all"><a href="http://health.yahoo.com/experts/healthieryou/">View All Posts &raquo;</a></p>
        </li>
        <li class="item">
            <a title="View Author's Biography" class="authimg"
               href="http://health.yahoo.com/experts/healthnews/bio/simeon-margolis/">

                <img width="125" height="154" border="0" class="lz"
                     alt="Simeon Margolis, M.D., Ph.D."
                     src="http://l.yimg.com/fz/ls/he/blogs/carousel/SimeonMargolis_carousel.png"/>
            </a>
            <h3><a href="http://health.yahoo.com/experts/healthnews/bio/simeon-margolis/">Simeon Margolis, M.D., Ph.D.</a></h3>
            <h4><a href="http://health.yahoo.com/experts/healthnews/13879/alzheimer-s-and-dementia-will-you-be-affected/">
            Alzheimer's and Dementia: Will…</a></h4>
            <cite>Posted Mon 4.28.08</cite>
            <p class="all"><a href="http://health.yahoo.com/experts/healthnews/">View All Posts &raquo;</a></p>

        </li>
        <li class="item">
            <a title="View Author's Biography" class="authimg"
               href="http://health.yahoo.com/experts/intentblog/bio/intentblog/">
                <img width="125" height="154" border="0" class="lz"
                     alt="Mallika Chopra, IntentBlog"
                     src="http://l.yimg.com/fz/ls/he/blogs/carousel/Intentblog_carousel.png"/>
            </a>
            <h3><a href="http://health.yahoo.com/experts/intentblog/bio/intentblog/">Mallika Chopra, IntentBlog</a></h3>
            <h4><a href="http://health.yahoo.com/experts/intentblog/2919/treating-a-sore-throat/">
            Treating a Sore Throat</a></h4>

            <cite>Posted Mon 4.28.08</cite>
            <p class="all"><a href="http://health.yahoo.com/experts/intentblog/">View All Posts &raquo;</a></p>
        </li>
        <li class="intro">
            <a href="http://health.yahoo.com/experts/">
                <img width="202" height="162" border="0"
                     alt="Health Expert Advice: Leading experts share advice, tips and personal experiences."
                     src="http://l.yimg.com/a/i/us/he/gr/v4/carouselintro.png"/>
            </a>
        </li>

    </ol>
</div>
<script>
    (function () {
        var carousel;
                
        YAHOO.util.Event.onDOMReady(function (ev) {
            var carousel    = new YAHOO.widget.Carousel("container", {
                        animation: { speed: 0.5 }
                });
                        
            carousel.render(); // get ready for rendering the widget
            carousel.show();   // display the widget
        });
    })();
</script>

