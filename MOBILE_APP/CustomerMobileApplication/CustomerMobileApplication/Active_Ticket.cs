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

namespace CustomerMobileApplication.Resources
{
    [Activity(Label = "Active_Ticket")]
    public class active_ticket : Activity
    {
        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);

            SetContentView(Resource.Layout.Active_Ticket);

            // Create your application here
        }
    }
}