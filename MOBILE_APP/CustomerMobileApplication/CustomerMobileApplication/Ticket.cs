using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Android.App;
using Android.Content;
using Android.OS;
using Android.Runtime;
using Android.Views;
using Android.Widget;

namespace CustomerMobileApplication
{
    class Ticket
    {
        public string ID { set; get; }

        public string PASSENGER_ID { set; get; }

        public string JOURNEY_ID { set; get; }

        public string BOOKING_ID { set; get; }

        public string BOOKING_TYPE { set; get; }

        public string SEAT_NUMBER { set; get; }

        public string SEAT_PREFERENCE { set; get; }

        public string DEPARTURE_PLATFORM { set; get; }

        public string ARRIVAL_DATE_TIME { set; get; }

        public string ARRIVAL_PLATFORM { set; get; }

        public string DEPARTURE_DATE_TIME { set; get; }
    }
}