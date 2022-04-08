<?xml version="1.0" encoding="UTF-8" ?>
<xsl:transform version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <div class="container">
            <div class="upper-section">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <td>Status</td>
                            <td>totalPrice</td>
                            <td>createdAt</td>
                            <td>updatedAt</td>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td><xsl:value-of select="ID"/></td>
                                <td><xsl:value-of select="status"/></td>
                                <td>RM<xsl:value-of select="totalPrice"/>.00</td>
                                <td><xsl:value-of select="createdAt"/></td>
                                <td><xsl:value-of select="updatedAt"/></td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </xsl:template>
</xsl:transform>
