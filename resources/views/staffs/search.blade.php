@extends('layout')
@section('content')
    <div class="container">
        <div class="upper-section">
            <h2>Staff Information</h2>
            <form id="register-form" method="get" action="">
                <h3>Filters to search</h3><br>
                <label>IC Number : </label><input type="text" name="icNumber" id="icNumber" value=""/><br><br>
                <label>Name : </label><input type="text" name="name" value=""/><br><br>
                <label>Position : </label><select name="position" value="">
                    <option value="">--Choose one--</option>
                    <option value="Waiter">Waiter</option>
                    <option value="Chef">Chef</option>
                    <option value="Manager">Manager</option>
                    <option value="Admin">Admin</option>
                </select><br><br>
                <label>Gender : </label><select name="gender" value="">
                    <option value="">--Choose one--</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select><br><br>
                <label>Phone no. : </label><input type="tel" name="mobile" value=""/><br><br>
                <input style="width:100px; height: 28px;" type="submit" name="submit" value="Search"/><br><br>
                <?php if (isset($_GET['submit'])){
                $doc = new \DOMDocument();
                $doc->preserveWhiteSpace = false;
                $doc->load('xml/staff_info.xml');
                $xpath = new \DOMXPath($doc);
                $x_ic = $_GET['icNumber'];
                $x_name = $_GET['name'];
                $x_position = $_GET['position'];
                $x_gender = $_GET['gender'];
                $x_mobile = $_GET['mobile'];
                $query = "//staffs/staff[ic[(contains(text(),'$x_ic'))] and name[(contains(text(),'$x_name'))]
                and position[(contains(text(),'$x_position'))]
                and gender[(contains(text(),'$x_gender'))]
                and mobile[(contains(text(),'$x_mobile'))]]/ic";
//                $query = "//staffs/staff/name[contains(text(),'$x_name')]";
                //                $query = "//staffs/staff/name[contains(text(),'$x_name')]/(.following-sibling::*|self::*)";
                //                 staffs/staff/position[contains(text(),'$x_position')]
                $entries = $xpath->query($query);
                ?>
                <table class="table">
                    <tr>
                        <td>IC Number</td>
                        <td>Name</td>
                        <td>Position</td>
                        <td>Gender</td>
                        <td>Phone no.</td>
                        <td>Date Registered</td>
                    </tr>
                    <tbody>
                    @foreach($entries as $entry)
                        <tr>
                            <td>{{ $entry->nodeValue }}</td>
                            <td>{{ $entry->nextSibling->nodeValue }}</td>
                            <td>{{ $entry->nextSibling->nextSibling->nodeValue }}</td>
                            <td>{{ $entry->nextSibling->nextSibling->nextSibling->nodeValue }}</td>
                            <td>{{ $entry->nextSibling->nextSibling->nextSibling->nextSibling->nodeValue }}</td>
                            <td>{{ $entry->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nodeValue }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table><br><br><?php } ?>

                <h3>Select sorting element</h3><br>
                {{--                {{ url('staff/search') }}--}}
                <label>Sort By : </label><select name="sortElement" value="">
                    <option value="-">--Choose one--</option>
                    <option value="IC Number">IC Number</option>
                    <option value="Name">Name</option>
                    <option value="Position">Position</option>
                    <option value="Mobile">Mobile</option>
                    <option value="Birth Date">Birth Date</option>
                    <option value="Register Date">Register Date</option>
                </select><br><br>
                <label>All the staff record is sorted by : <?php if (isset($_GET['sort'])) {
                        echo $_GET['sortElement'];
                    }; ?></label><br><br>

                <input style="width:100px; height: 28px;" type="submit" name="sort" value="Sort"/>
                <button style="width: 100px; height: 28px;"><a style="color: black; text-decoration: none; "
                                                               href="javascript:history.back()"><i
                            aria-hidden="true"></i> Back</a></button>
                <br><br>
            </form>
        </div>
        <?php if (!isset($_GET['sort'])) {
            echo "No record being sort";
            echo "<br><br>";
        }; ?>
    </div>
    <?php
    //sort function
    if (isset($_GET['sort'])) {
        $value = $_GET['sortElement'];

        $xml = new \DOMDocument();
        $xml->load('xml/staff_info.xml');

        $xsl = new \DOMDocument();

        if ($value == "IC Number") {
            $xsl->load('xml/staff_sort_icNumber.xslt');
        }
        if ($value == "Name") {
            $xsl->load('xml/staff_sort_name.xslt');
        }
        if ($value == "Position") {
            $xsl->load('xml/staff_sort_position.xslt');
        }
        if ($value == "Mobile") {
            $xsl->load('xml/staff_sort_mobile.xslt');
        }
        if ($value == "Register Date") {
            $xsl->load('xml/staff_sort_dateRegistered.xslt');
        }
        if ($value == "Birth Date") {
            $xsl->load('xml/staff_sort_dateBirth.xslt');
        }
        if ($value == "-") {
            $xsl->load('xml/staff_info.xslt');
        }

        $proc = new \XSLTProcessor();
        $proc->importStylesheet($xsl);

        echo $proc->transformToXml($xml);
        echo "<br><br>";
    }
    ?>
@stop
