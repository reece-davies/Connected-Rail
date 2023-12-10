<div class="container-fluid">
    <div class="row">
        <!-- STAFF ACCOUNTS -->
        <div class="col-lg-12">
            <div class="dashboard-content-section" style="height: 50vh !important;">

                <!-- staff header -->
                <div class="dashboard-section-header" style="overflow: hidden;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8">
                                <i class="fas fa-users header-with-icon"><span>Staff Members</span></i>
                            </div>
                            <div class="col-4">
                                <i id="add-new-staff" class="fas fa-plus add-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                                <i id="search-staff-accounts" class="fas fa-search search-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- staff -->
                <div class="container-fluid" id="append-staff-here" style="margin-top: 0px;">

                    <?php

                    // Send API request to fetch staff accounts from database:
                    $result = file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/staffs');
                    $data = json_decode($result, true);

                    // Output fetched data to the screen:
                    if ($data !== '[]')
                    {
                        for ($i = 0; $i < sizeof($data); $i++)
                        {
                            $staffPhoto = $data[$i]['PHOTO'];

                            if ($data[$i]['PHOTO'] == null || $data[$i]['PHOTO'] == 'null' || $data[$i]['PHOTO'] == '')
                            {
                                $staffPhoto = 'https://png.pngtree.com/svg/20170331/1ec867769d.svg';
                            }

                            echo '
                            <div class="row staff-member"
                                data-id="' . $data[$i]['ID'] . '"
                                data-image="' . $staffPhoto . '"
                                data-firstName="' . $data[$i]['FIRST_NAME'] . '"
                                data-lastName="' . $data[$i]['LAST_NAME'] . '"
                                data-email="' . $data[$i]['EMAIL_ADDRESS'] . '"
                                data-dob="' . $data[$i]['DATE_OF_BIRTH'] . '"
                                data-gender="' . $data[$i]['GENDER'] . '"
                                data-role="' . $data[$i]['STAFF_ROLE'] . '">

                                <!-- staff photo -->
                                <div class="col-sm">
                                    <p class="staff-image-wrapper">
                                        <img src="' . $staffPhoto . '" class="staff-image">
                                    </p>
                                </div>
        
                                <!-- staff name -->
                                <div class="col-sm">
                                    <p class="staff-name staff-information">' . $data[$i]['FIRST_NAME'] . " " . $data[$i]['LAST_NAME'] . '</p>
                                </div>
        
                                <!-- role -->
                                <div class="col-sm">
                                    <p class="staff-role staff-information">' . $data[$i]['STAFF_ROLE'] . '</p>
                                </div>
        
                                <!-- account status -->
                                <div class="col-sm">
                                    <p class="staff-status staff-information">Active</p>
                                </div>
                            </div>
                            <div class="content-divider"></div>
                            ';

                            if ($i == sizeof($data) - 1)
                            {
                                echo '<div style="height: 50px;"></div>';
                            }
                        }
                    }
                    else
                    {
                        // Display no staff accounts?
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>

    <!-- TRAIN JOURNEYS -->
    <div class="row">

        <!-- TRAIN JOURNEYS-->
        <div class="col-lg-6">
            <div class="dashboard-content-section slightly-bigger-section">

                <div class="dashboard-section-header" style="overflow: hidden;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8">
                                <i class="fas fa-suitcase header-with-icon"><span>Journeys</span></i>
                            </div>
                            <div class="col-4">
                                <i id="search-staff-accounts" class="fas fa-search search-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- journey data here -->
                <div class="container-fluid" id="append-journeys-here" style="margin-top: 0px;">

                    <?php

                    // Send API request to fetch staff accounts from database:
                    $result = file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_journey');
                    $data = json_decode($result, true);

                    // Output fetched data to the screen:
                    if ($data !== '[]')
                    {
                        for ($i = 0; $i < sizeof($data); $i++)
                        {
                            $selected = '';

                            if ($i === 0)
                            {
                                //$selected = 'selected-journey';
                            }

                            $arrival = json_decode(file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/locations/' . $data[$i]['ARRIVAL_LOCATION_ID']), true);
                            $departure = json_decode(file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/locations/' . $data[$i]['DEPARTURE_LOCATION_ID']), true);

                            echo '
                            <div class="row journey ' . $selected . '"
                                data-id="' . $data[$i]['ID'] . '"
                                data-arrivalLocationId="' . $data[$i]['ARRIVAL_LOCATION_ID'] . '"
                                data-arrivalLocationName="' . $arrival['TRAIN_STATION_NAME'] . '"
                                data-departureLocationId="' . $data[$i]['DEPARTURE_LOCATION_ID'] . '"
                                data-departureLocationName="' . $departure['TRAIN_STATION_NAME'] . '"
                                data-cost="' . $data[$i]['JOURNEY_COST'] . '"
                                >
                                
                                <!-- depart -->
                                <div class="col-sm">
                                    <p class="depart-name journey-information">From: <span>' . $departure['TRAIN_STATION_NAME'] . '</span></p>
                                </div>
        
                                <!-- arrive -->
                                <div class="col-sm">
                                    <p class="arrive-name journey-information">To: <span>' . $arrival['TRAIN_STATION_NAME'] .'</span></p>
                                </div>
        
                                <!--<div class="col-sm">
                                    <p class="depart-time journey-information">Active: <span>YES</span></p>
                                </div>-->
                                
                            </div>
                            <div class="content-divider"></div>
                            ';

                            if ($i === sizeof($data) - 1)
                            {
                                echo '<div style="height: 50px;"></div>';
                            }
                        }
                    }

                    ?>

                </div>

            </div>
        </div>

        <!-- TRAIN JOURNEY STAFF -->
        <div class="col-lg-6">
            <div class="dashboard-content-section slightly-bigger-section">
                <div class="dashboard-section-header" style="overflow: hidden;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8">
                                <i class="fas fa-users header-with-icon"><span>Journey Staff</span></i>
                            </div>
                            <div class="col-4">
                                <i id="add-journey-staff" class="fas fa-plus add-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- journey staff data here -->
                <div class="container-fluid" id="append-journey-staff-here" style="margin-top: 0px;">

                </div>
            </div>
        </div>
    </div>

    <!-- FULL JOURNEY (IN RELATION TO STAFF) BREAKDOWN -->
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-content-section" style="height: unset !important;">
                <div class="dashboard-section-header" style="overflow: hidden;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <i class="fas fa-info-circle header-with-icon"><span>Journey Breakdown</span></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- journey breakdown data -->
                <div class="container-fluid" id="append-journey-summary-here" style="margin-top: 0px;">

                    <div class="row journey-summary">

                        <!-- journey cost -->
                        <div class="col">
                            <p id="journey-cost" class="journey-arrival journey-information">Price:</p>
                        </div>

                        <!-- staff members assigned to journey -->
                        <div class="col">
                            <p id="assigned-staff" class="assigned-staff-count journey-information">Staff:</p>
                        </div>

                        <!-- status (on time / delayed) -->
                        <div class="col">
                            <p id="journey-status" class="journey-status journey-information">Status</p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>