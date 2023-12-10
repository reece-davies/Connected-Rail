using Android.App;
using Android.OS;
using Android.Support.V7.App;
using Android.Runtime;
using Android.Widget;
using System;
using System.Net.Http;
using Newtonsoft.Json;
using System.Linq;
using System.Collections.Generic;
using System.Text;
using Android.Content;


namespace API_test
{
    [Activity(Label = "@string/app_name", Theme = "@style/AppTheme", MainLauncher = true)]
    public class MainActivity : AppCompatActivity
    {
        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);
            // Set our view from the "main" layout resource
            SetContentView(Resource.Layout.activity_main);

            GetPassengers();

        }

        private async void GetPassengers()
        {
            //throw new NotImplementedException();

            HttpClient client = new HttpClient();
            var response = await client.GetStringAsync("http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/passengers");

            var passengers = JsonConvert.DeserializeObject<List<Passengers>>(response);

            

            ListView listView1 = FindViewById<ListView>(Resource.Id.listView1);
            listView1.ItemsSource = passengers;
            

        }
    }
}