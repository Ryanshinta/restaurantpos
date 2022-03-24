<?xml version="1.0" encoding="UTF-8" ?>
<xsl:transform version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <div class="container">
            <div class="upper-section">
                <h2>Staff Information</h2>
                <h4>Insert search condition</h4><br></br>
                <form id="register-form" method="POST" action="{{ url('staff/display') }}">
                    <label>IC Number : </label><input type="text" name="icNumber" id="icNumber" value="" placeholder="xxxxxx-xx-xxxx"/><br></br><br></br>

                    <label>Full Name : </label><input type="text" name="name" value=""/><br></br><br></br>

                    <label>Position : </label><select name="position" value="">
                    <option value="Waiter">Waiter</option>
                    <option value="Chef">Chef</option>
                    <option value="Manager">Manager</option>
                    <option value="Admin">Admin</option>
                </select><br></br><br></br>

                    <label>Gender : </label><input type="radio" name="gender" value="Female"/>Female
                    <input type="radio" name="gender" value="Male"/>Male<br></br><br></br>

                    <label>Phone no. : </label><input type="tel" name="mobile" value="" placeholder="xxx-xxxxxxx"/><br></br><br></br>

                    <label>Email : </label><input type="text" name="email" value=""
                                                  placeholder="example@email.com"/><br></br><br></br>

                    <label>Birthday : </label><input type="date" name="birthday" value=""/><br></br><br></br>

                    <label>Address : </label><input type="text" name="address" value=""/><br></br><br></br>

                    <input style="width:100px; height: 28px;" type="submit" name="submit" value="Search"/>
                    <button style="width: 100px; height: 28px;"><a style="color: black; text-decoration: none; "
                                                                   href="javascript:history.back()"><i
                        aria-hidden="true"></i> Back</a></button>
                    <br></br><br></br>
                </form>
                <table>
                    <thead>
                        <tr>
                            <td>IC Number</td>
                            <td>Name</td>
                            <td>Position</td>
                            <td>Gender</td>
                            <td>Mobile</td>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="staffs/staff">
                            <tr>
                                <td><xsl:value-of select="ic"/></td>
                                <td><xsl:value-of select="name"/></td>
                                <td><xsl:value-of select="position"/></td>
                                <td><xsl:value-of select="gender"/></td>
                                <td><xsl:value-of select="mobile"/></td>
                            </tr>
                        </xsl:for-each>
                    </tbody>
                </table>
            </div>
        </div>
    </xsl:template>
</xsl:transform>
