<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-content-section" style="height: 50vh !important;">

                <!-- passenger header -->
                <div class="dashboard-section-header" style="overflow: hidden;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8">
                                <i class="fas fa-users header-with-icon"><span>Passengers</span></i>
                            </div>
                            <div class="col-4">
                                <i id="search-passenger-accounts" class="fas fa-search search-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- passenger data -->
                <div class="container-fluid" id="append-passengers-here" style="margin-top: 0px;">

                    <?php

                    // Send API request to fetch passenger accounts from database:
                    $result = file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/passengers');
                    $data = json_decode($result, true);

                    // Output fetched data to the screen:
                    if ($data !== '[]')
                    {
                        for ($i = 0; $i < sizeof($data); $i++)
                        {
                            $passengerPhoto = $data[$i]['PHOTO'];

                            if ($data[$i]['PHOTO'] == null || $data[$i]['PHOTO'] == 'null' || $data[$i]['PHOTO'] == '')
                            {
                                $passengerPhoto = 'https://png.pngtree.com/svg/20170331/1ec867769d.svg';
                            }

                            echo '
                            <div class="row staff-member passenger"
                                data-id="' . $data[$i]['ID'] . '"
                                data-image="' . $passengerPhoto . '"
                                data-firstName="' . $data[$i]['FIRST_NAME'] . '"
                                data-lastName="' . $data[$i]['LAST_NAME'] . '"
                                data-email="' . $data[$i]['EMAIL_ADDRESS'] . '"
                                data-dob="' . $data[$i]['DATE_OF_BIRTH'] . '"
                                data-gender="' . $data[$i]['GENDER'] . '">

                                <!-- passenger photo -->
                                <div class="col-sm">
                                    <p class="staff-image-wrapper">
                                        <img src="' . $passengerPhoto . '" class="staff-image">
                                    </p>
                                </div>
        
                                <!-- passenger name -->
                                <div class="col-sm">
                                    <p class="staff-name staff-information">' . $data[$i]['FIRST_NAME'] . " " . $data[$i]['LAST_NAME'] . '</p>
                                </div>
        
                                <!-- passenger email -->
                                <div class="col-sm">
                                    <p class="staff-status staff-information">' . $data[$i]['EMAIL_ADDRESS'] . '</p>
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
                        // Display no passenger accounts?
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-content-section" style="height: 50vh !important;">

                <!-- bookings header -->
                <div class="dashboard-section-header" style="overflow: hidden;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8">
                                <i class="fas fa-ticket-alt header-with-icon"><span>Bookings</span></i>
                            </div>
                            <div class="col-4">
                                <i id="search-bookings" class="fas fa-search search-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- booking data -->
                <div class="container-fluid" id="append-bookings-here" style="margin-top: 0px;">

                    <?php

                    // Send API request to fetch bookings from database:
                    $result = file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/bookings');
                    $data = json_decode($result, true);

                    // Output fetched data to the screen:
                    if ($data !== '[]')
                    {
                        for ($i = 0; $i < sizeof($data); $i++)
                        {
                            $passenger  = json_decode(file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/passengers/' . $data[$i]['PASSENGER_ID']), true);
                            $journey    = json_decode(file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_journey/' . $data[$i]['JOURNEY_ID']), true);
                            $departure  = json_decode(file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/locations/' . $journey['DEPARTURE_LOCATION_ID']), true);
                            $arrival    = json_decode(file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/locations/' . $journey['ARRIVAL_LOCATION_ID']), true);

                            $passengerPhoto = $data[$i]['PHOTO'];

                            if ($passenger['PHOTO'] == null || $passenger['PHOTO'] == 'null' || $passenger['PHOTO'] == '')
                            {
                                $passengerPhoto = 'https://png.pngtree.com/svg/20170331/1ec867769d.svg';
                            }

                            echo '
                            <div class="row staff-member booking"
                                data-id="' . $data[$i]['ID'] . '"
                                data-passengerId = "' . $passenger['ID'] . '"
                                data-image="' . $passengerPhoto . '"
                                data-firstName="' . $passenger['FIRST_NAME'] . '"
                                data-lastName="' . $passenger['LAST_NAME'] . '"
                                data-email="' . $passenger['EMAIL_ADDRESS'] . '"
                                data-dob="' . $passenger['DATE_OF_BIRTH'] . '"
                                data-gender="' . $passenger['GENDER'] . '"
                                data-seatNumber="' . $data[$i]['SEAT_NUMBER'] . '"
                                data-seatPreference="' . $data[$i]['SEAT_PREFERENCE'] . '"
                                data-departTime="' . $data[$i]['DEPARTURE_DATE_TIME'] . '"
                                data-arriveTime="' . $data[$i]['ARRIVAL_DATE_TIME'] . '"
                                data-departurePlatform="' . $data[$i]['DEPARTURE_PLATFORM'] . '"
                                data-arrivalPlatform="' . $data[$i]['ARRIVAL_PLATFORM'] . '"
                                data-bookingType="' . $data[$i]['BOOKING_TYPE'] . '"
                                data-departLocation="' . $departure['TRAIN_STATION_NAME'] . '"
                                data-arriveLocation="' . $arrival['TRAIN_STATION_NAME'] . '"
                                data-journeyId="' . $data[$i]['JOURNEY_ID'] . '">

                                <!-- passenger photo -->
                                <div class="col-sm">
                                    <p class="staff-image-wrapper">
                                        <img src="' . $passengerPhoto . '" class="staff-image">
                                    </p>
                                </div>
        
                                <!-- passenger name -->
                                <div class="col-sm">
                                    <p class="staff-name staff-information">' . $passenger['FIRST_NAME'] . " " . $passenger['LAST_NAME'] . '</p>
                                </div>
                                
                                <!-- seat number -->
                                <div class="col-sm">
                                    <p class="staff-name staff-information">Seat Number: ' . $data[$i]['SEAT_NUMBER'] . '</p>
                                </div>
                                
                                <!-- booking type -->
                                <div class="col-sm">
                                    <p class="staff-status staff-information">' . $data[$i]['BOOKING_TYPE'] . '</p>
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
                        // Display no bookings accounts?
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>
</div>