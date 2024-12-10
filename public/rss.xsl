<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" />

    <xsl:template match="/rss">
        <html>
            <head>
                <title>Flux RSS - Tsarbucks</title>
                <!-- Lien vers le fichier CSS de Bootstrap -->
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
                <!-- Lien vers ton fichier CSS personnalisé -->
                <link rel="stylesheet" href="/css/rss-style.css" />
            </head>
            <body class="container">
                <h1 class="my-4 text-center">Les Dernières Nouvelles de Tsarbucks</h1>
                <ul class="list-group">
                    <xsl:for-each select="channel/item">
                        <li class="list-group-item mb-3 shadow-sm">
                            <h2><xsl:value-of select="title" /></h2>
                            <p><xsl:value-of select="description" /></p>
                            <a href="{link}" class="btn btn-success">Lire plus</a>
                            <p class="text-muted mt-2"><xsl:value-of select="pubDate" /></p>
                        </li>
                    </xsl:for-each>
                </ul>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
