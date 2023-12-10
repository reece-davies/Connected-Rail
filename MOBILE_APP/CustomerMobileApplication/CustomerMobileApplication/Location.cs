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
    class Location
    {
        public string ID { set; get; }

        public string CITY_NAME { set; get; }

        public string TRAIN_STATION_NAME { set; get; }

        public string LATITUDE { set; get; }

        public string LONGITUDE { set; get; }
    }
}