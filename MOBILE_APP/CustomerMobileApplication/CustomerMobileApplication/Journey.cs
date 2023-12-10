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
    class Journey
    {
        public string ID { set; get; }

        public string JOURNEY_COST { set; get; }

        public string ARRIVAL_LOCATION_ID { set; get; }

        public string DEPARTURE_LOCATION_ID { set; get; }
    }
}