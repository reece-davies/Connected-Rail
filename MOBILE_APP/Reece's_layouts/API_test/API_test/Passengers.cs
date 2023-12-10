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

namespace API_test
{
    class Passengers
    {
        public int ID { set; get; }
        public string emailAddress { set; get; }
        public string password { set; get; }
        public string firstName { set; get; }
        public string lastName { set; get; }
        public string DOB { set; get; }
        public string gender { set; get; }
        public string photo { set; get; }
    }
}