<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="About">

        <html>
            <head>
                <link rel="stylesheet" href="stylesheets/c1.css"/>

                <title>Document</title>
            </head>
            <body>

                <header>
                    <div class="nav">
                        <ul>
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li>
                                <a href="login.php">Login</a>
                            </li>
                            <li>
                                <a href="faq.xml">FAQ's</a>
                            </li>
                            <li>
                                <a class="active">About</a>
                            </li>
                        </ul>
                    </div>
                </header>

                <div class="container">

                    <div class="about">
                        <div class="left">
                            <h1>About us</h1>
                            <hr/>
                            <p>
                                <xsl:value-of select="content"/>
                            </p>



                        </div>
                        <div class="right">
                            <img src="images/i3.jpg"/>
                        </div>
                        <div class="clear"></div>
                    </div>



                    <div class="mission">

                        <div class="left">
                            <img src="images/i2.jpg"/>
                        </div>
                        <div class="right">
                            <h1>Mission Statement</h1>
                            <hr/>
                            <p>
                                <xsl:value-of select="mission"/>
                            </p>



                        </div>
                        <div class="clear"></div>

                    </div>



                    <div class="team">
                        <h1> Our Team<hr/>
                        </h1>


                        <xsl:for-each select="team">

                            <div class="card">
                                <div class="circle-container">
                                    <h1 style="color:#fff;"><xsl:value-of select="thumbnail"/></h1>
                                </div>
                                <h2><xsl:value-of select="name"/></h2>
                                <h4><xsl:value-of select="work"/></h4>
                                <p><xsl:value-of select="info"/></p>
                            </div>
                        </xsl:for-each>
                       






                    </div>


                </div>
                <footer>
                    <br/>
                    <p>Copyright ©2020 healthcare portal. All rights reserved</p>
                </footer>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>