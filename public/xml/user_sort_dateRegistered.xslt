<?xml version="1.0" encoding="UTF-8" ?>
<xsl:transform version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <div class="container">
            <div class="upper-section">
                <table>
                    <thead>
                        <tr>
                            <td>IC Number</td>
                            <td>Name</td>
                            <td>Role</td>
                            <td>Gender</td>
                            <td>Mobile</td>
                            <td>Birthday</td>
                            <td>Date Register</td>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="users/user">
                            <xsl:sort select="dateRegistered"/>
                            <tr>
                                <td><xsl:value-of select="ic"/></td>
                                <td><xsl:value-of select="name"/></td>
                                <td><xsl:value-of select="role"/></td>
                                <td><xsl:value-of select="gender"/></td>
                                <td><xsl:value-of select="mobile"/></td>
                                <td><xsl:value-of select="birthday"/></td>
                                <td><xsl:value-of select="dateRegistered"/></td>
                            </tr>
                        </xsl:for-each>
                    </tbody>
                </table>
            </div>
        </div>
    </xsl:template>
</xsl:transform>
