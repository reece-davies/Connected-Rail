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
    class Passenger
    {
        public string EMAIL_ADDRESS { set; get; }

        public string PASSWORD { set; get; }

        public string ID { set; get; }

        public string FIRST_NAME { set; get; }

        public string LAST_NAME { set; get; }

        public string GENDER { set; get; }

        public string DATE_OF_BIRTH { set; get; }
    }
}