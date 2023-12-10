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
using Newtonsoft.Json;

namespace CustomerMobileApplication.Resources
{
    [Activity(Label = "New Booking")]
    public class Create_Booking : Activity
    {
        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);

            // Set our view from the "main" layout resource
            SetContentView(Resource.Layout.Create_Booking);
            Passenger thisPassenger = JsonConvert.DeserializeObject<Passenger>(Intent.GetStringExtra("Passenger"));

            // Create your application here

            FindViewById<Button>(Resource.Id.button_searchTrains).Click += (o, e) =>
            {
                //StartActivity(typeof(Ticket_Search));
                //Finish();

                var intent = new Intent(this, typeof(Ticket_Search));
                intent.PutExtra("Passenger", JsonConvert.SerializeObject(thisPassenger));
                StartActivity(intent);
            };

            
            //FindViewById<Button>(Resource.Id.button_searchTrains).Text = thisPassenger.ID;


            FindViewById<Button>(Resource.Id.button_viewTickets).Click += (o, e) =>
            {
                var intent = new Intent(this, typeof(View_Active_Tickets));
                intent.PutExtra("Passenger", JsonConvert.SerializeObject(thisPassenger));
                StartActivity(intent);
            };

            FindViewById<Button>(Resource.Id.button_expiredTickets).Click += (o, e) =>
            {
                var intent = new Intent(this, typeof(View_Expired_Tickets));
                intent.PutExtra("Passenger", JsonConvert.SerializeObject(thisPassenger));
                StartActivity(intent);
            };

            
            // Code for checkbox //////////////////////////////////////////////////
            CheckBox checkBox_single = FindViewById<CheckBox>(Resource.Id.checkBox_single);
            CheckBox checkBox_return = FindViewById<CheckBox>(Resource.Id.checkBox_return);
            CheckBox checkBox_singleReturn = FindViewById<CheckBox>(Resource.Id.checkBox_singleReturn);

            checkBox_single.Click += (o, e) => {
                if (checkBox_single.Checked)
                {
                    Toast.MakeText(this, "Selected", ToastLength.Short).Show();

                    checkBox_return.Checked = false;
                    checkBox_singleReturn.Checked = false;
                }
                else
                    Toast.MakeText(this, "Not selected", ToastLength.Short).Show();
            };

            checkBox_return.Click += (o, e) => {
                if (checkBox_return.Checked)
                {
                    Toast.MakeText(this, "Selected", ToastLength.Short).Show();

                    checkBox_single.Checked = false;
                    checkBox_singleReturn.Checked = false;
                }
                else
                    Toast.MakeText(this, "Not selected", ToastLength.Short).Show();
            };

            checkBox_singleReturn.Click += (o, e) => {
                if (checkBox_singleReturn.Checked)
                {
                    Toast.MakeText(this, "Selected", ToastLength.Short).Show();

                    checkBox_single.Checked = false;
                    checkBox_return.Checked = false;
                }
                else
                    Toast.MakeText(this, "Not selected", ToastLength.Short).Show();
            };

            
        }
    }
}