<?xml version="1.0" encoding="UTF-8" ?>
<xsl:transform version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <div class="container">
            <div class="upper-section">
                <table  class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="Products/Product">
                        <xsl:sort select="price"/>
                        <tr>
                            <td><xsl:value-of select="ID"/></td>
                            <td><xsl:value-of select="name"/></td>
                            <td>
                                <img width="100">
                                    <xsl:attribute name="src">
                                        <xsl:value-of select="imagePath"/>
                                    </xsl:attribute>
                                </img>
                            </td>
                            <td>RM <xsl:value-of select="price"/></td>
                            <td><xsl:value-of select="description"/></td>
                            <td><xsl:value-of select="createdAt"/></td>
                            <td><xsl:value-of select="updatedAt"/></td>
                        </tr>
                        </xsl:for-each>
                    </tbody>
                </table>
            </div>
        </div>
    </xsl:template>
</xsl:transform>
