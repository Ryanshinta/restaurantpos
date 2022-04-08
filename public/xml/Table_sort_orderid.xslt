<?xml version="1.0" encoding="UTF-8" ?>
<xsl:transform version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <div class="container">
            <div class="upper-section">
                <table>
                    <thead>
                        <tr>
                            <td>Table Status</td>
                            <td>Table Type</td>
                            <td>Max Seats</td>
                            <td>OrderID</td>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="tables//table">
                            <xsl:sort select="orderID"/>
                            <tr>
                                <td><xsl:value-of select="tableStatus"/></td>
                                <td><xsl:value-of select="tableType"/></td>
                                <td><xsl:value-of select="maxSeats"/></td>
                                <td><xsl:value-of select="orderID"/></td>
                            </tr>
                        </xsl:for-each>
                    </tbody>
                </table>
            </div>
        </div>
    </xsl:template>
</xsl:transform>
