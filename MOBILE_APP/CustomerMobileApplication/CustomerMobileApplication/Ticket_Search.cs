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
    [Activity(Label = "Ticket_Search")]
    public class Ticket_Search : Activity
    {
        private List<string> myTrains;

        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);

            SetContentView(Resource.Layout.Ticket_Search);

            // Create your application here

            TextView textView_Cancel = FindViewById<TextView>(Resource.Id.textView_Cancel);

            textView_Cancel.Click += delegate
            {
                Finish();
            };

            

            // Adds items to listView
            ListView listAvailableTrains = FindViewById<ListView>(Resource.Id.listView_trainsAvailable);
            myTrains = new List<string>();
            myTrains.Add("Train journey 1");
            myTrains.Add("Train journey 2");
            myTrains.Add("Train journey 3");

            // Adapter for the list
            ArrayAdapter<string> listAdapter = new ArrayAdapter<string>(this, Android.Resource.Layout.SimpleListItem1, myTrains);
            listAvailableTrains.Adapter = listAdapter;





        }

        
    }
}