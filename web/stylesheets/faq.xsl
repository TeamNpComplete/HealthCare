<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="FAQs">
        <html>
            <head>
                <title>Health Care - FAQ</title>
                <link rel="stylesheet" href="/stylesheets/faq.css"/>
            </head>
            <body>
                <header>
                    <ul>
                        <li>
                            <a href="home.html">Home</a>
                        </li>
                        <li>
                            <a href="login.php">Login</a>
                        </li>
                        <li>
                            <a class="active" href="#contact">FAQ's</a>
                        </li>
                        <li>
                            <a href="about.html">About</a>
                        </li>
                    </ul>
                </header>
                <section class="container">
                    <h1>FAQ Section</h1>
                    <xsl:for-each select="QA">
                        <section class="acc">
                            <h3 class="active">
                                <xsl:value-of select="Question"/>
                            </h3>
                            <content class="content">
                                <section class="content-inner">
                                    <p>
                                        <xsl:value-of select="Answer"/>
                                    </p>
                                </section>
                            </content>
                        </section>
                    </xsl:for-each>
                </section>
                <footer>
                    <br/>
                    <p>Copyright ©2020 Healthcare portal. All right reserved.</p>
                </footer>
                <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
                <script type="text/javascript" src="/scripts/faq.js"></script>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>