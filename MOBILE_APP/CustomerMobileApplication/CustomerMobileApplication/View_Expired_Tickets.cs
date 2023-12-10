using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using Android.App;
using Android.Content;
using Android.OS;
using Android.Runtime;
using Android.Views;
using Android.Widget;
using CustomerMobileApplication.Resources;
using Newtonsoft.Json;

namespace CustomerMobileApplication
{
    [Activity(Label = "Expired Tickets")]
    public class View_Expired_Tickets : Activity
    {
        private List<string> myStrings;
        private List<Ticket> myTickets;
        private List<Journey> myJourneys;
        private List<Location> myLocations_dep;
        private List<Location> myLocations_arr;

        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);

            SetContentView(Resource.Layout.View_Expired_Tickets);
            Passenger thisPassenger = JsonConvert.DeserializeObject<Passenger>(Intent.GetStringExtra("Passenger"));

            // Create your application here


            // Adds items to listView
            ListView listExpiredTickets = FindViewById<ListView>(Resource.Id.listView_expiredTickets);
            myStrings = new List<string>();


            myTickets = new List<Ticket>();
            myJourneys = new List<Journey>();
            myLocations_dep = new List<Location>();
            myLocations_arr = new List<Location>();

            // Adapter for the list
            ArrayAdapter<string> listAdapter = new ArrayAdapter<string>(this, Android.Resource.Layout.SimpleListItem1, myStrings);
            listExpiredTickets.Adapter = listAdapter;

            // When refresh button is clicked
            Button refresh = FindViewById<Button>(Resource.Id.button_refresh);


            refresh.Click += async delegate
            {
                // GETTING all users from the database, and making a list of Json objects
                string allTickets = await FetchTicketData();
                List<Ticket> parsedJSON = JsonConvert.DeserializeObject<List<Ticket>>(allTickets);

                // Fetch all journeys from database
                string allJourneys = await FetchJourneyData();
                List<Journey> parsedJSON_journey = JsonConvert.DeserializeObject<List<Journey>>(allJourneys);

                // Fetch all locations from database
                string allLocations = await FetchLocationData();
                List<Location> parsedJSON_location = JsonConvert.DeserializeObject<List<Location>>(allLocations);

                Console.WriteLine("BUTTON CLICKED");

                // Loops through all passengers, and finds the one equivelant to user input
                foreach (Ticket lp in parsedJSON)
                {
                    if (lp.PASSENGER_ID == thisPassenger.ID)
                    {
                        DateTime now = DateTime.Now.ToLocalTime();
                        int result = DateTime.Compare(now, Convert.ToDateTime(lp.DEPARTURE_DATE_TIME));

                        Console.WriteLine("TIME ------" + now);
                        Console.WriteLine("TIME ------" + lp.DEPARTURE_DATE_TIME);
                        Console.WriteLine("TIME ------" + result);

                        if (result > 0)
                        {
                            Console.WriteLine("TIME ------" + lp.DEPARTURE_DATE_TIME);


                            myTickets.Add(lp);
                            //myStrings.Add(lp.PASSENGER_ID + ", " + lp.JOURNEY_ID);

                            foreach (Journey jo in parsedJSON_journey)
                            {
                                if (jo.ID == lp.JOURNEY_ID)
                                {
                                    myJourneys.Add(jo);
                                    //myStrings.Add(jo.ID + ", " + jo.DEPARTURE_LOCATION_ID);

                                    foreach (Location lo in parsedJSON_location)
                                    {
                                        if (lo.ID == jo.DEPARTURE_LOCATION_ID)
                                        {
                                            myLocations_dep.Add(lo);
                                            //myStrings.Add(lo.ID);

                                            //myStrings.Add("Ticket ID: " + lp.ID + ", " + lo.TRAIN_STATION_NAME);
                                            myStrings.Add(lp.ID);
                                        }

                                        if (lo.ID == jo.ARRIVAL_LOCATION_ID)
                                        {
                                            myLocations_arr.Add(lo);
                                        }
                                    }
                                }
                            }
                        }
                        
                        // Make new passenger with lp details
                        //myStrings.Add(lp.ID);

                        ArrayAdapter<string> newListAdapter = new ArrayAdapter<string>(this, Android.Resource.Layout.SimpleListItem1, myStrings);
                        listExpiredTickets.Adapter = newListAdapter;
                    }
                }
            };

            // Create method for click event
            listExpiredTickets.ItemClick += ListExpiredTickets_ItemClick;

            // To sign out
            TextView textView_signout = FindViewById<TextView>(Resource.Id.textView_signout);
            textView_signout.Click += delegate
            {
                StartActivity(typeof(MainActivity));
                Finish();
            };




            FindViewById<Button>(Resource.Id.button_makeBooking).Click += (o, e) =>
            {
                var intent = new Intent(this, typeof(Create_Booking));
                intent.PutExtra("Passenger", JsonConvert.SerializeObject(thisPassenger));
                StartActivity(intent);
            };

            FindViewById<Button>(Resource.Id.button_viewTickets).Click += (o, e) =>
            {
                var intent = new Intent(this, typeof(View_Active_Tickets));
                intent.PutExtra("Passenger", JsonConvert.SerializeObject(thisPassenger));
                StartActivity(intent);
            };
        }

        private void ListExpiredTickets_ItemClick(object sender, AdapterView.ItemClickEventArgs e)
        {

            //throw new NotImplementedException();

            ListView selectedList = FindViewById<ListView>(Resource.Id.listView_expiredTickets);
            var selectedItem = selectedList.GetItemAtPosition(e.Position);

            int selectedItemNum = 0;
            Int32.TryParse(selectedItem.ToString(), out selectedItemNum);

            Console.WriteLine("NAME ================ " + selectedItem);
            
            for (int i = 0; i < myStrings.Count(); i++)
            {

                int userId = Convert.ToInt32(myTickets[i].ID);

                if (selectedItemNum == userId)
                {
                    string date = myTickets[i].DEPARTURE_DATE_TIME;
                    string ticketId = myTickets[i].ID;
                    string bookingType = myTickets[i].BOOKING_TYPE;
                    string seatNumber = myTickets[i].SEAT_NUMBER;
                    string depStation = myLocations_dep[i].TRAIN_STATION_NAME;
                    string depTime = myTickets[i].DEPARTURE_DATE_TIME;
                    string arrivalStation = myLocations_arr[i].TRAIN_STATION_NAME;
                    string arrivalTime = myTickets[i].ARRIVAL_DATE_TIME;

                    string departPlatform = myTickets[i].DEPARTURE_PLATFORM;
                    string arrivalPlatform = myTickets[i].ARRIVAL_PLATFORM;

                    var dialogView = LayoutInflater.Inflate(Resource.Layout.Expired_Ticket, null);
                    AlertDialog alertDialog;
                    using (var dialog = new AlertDialog.Builder(this))
                    {
                        dialog.SetView(dialogView);
                        dialog.SetNegativeButton("Cancel", (s, a) => { });
                        alertDialog = dialog.Create();
                    }
                    var items = new string[] { "Date: --EXPIRED-- (" + date + ")", "Ticket ID: " + ticketId, "Booking Type: " + bookingType, "Seat Number: " + seatNumber, "Depart Time: " + depTime, "Depart Station: " + depStation, "Depart Platform: " + departPlatform, "Arrival Time: " + arrivalTime, "Arrival Station: " + arrivalStation, "Arrival Platform: " + arrivalPlatform };
                    var adapter = new ArrayAdapter<string>(this, Android.Resource.Layout.SimpleListItem1, items);
                    dialogView.FindViewById<ListView>(Resource.Id.listView_viewExpiredTicket).Adapter = adapter;
                    alertDialog.Show();
                }
            }



        }

        public async Task<string> FetchTicketData()
        {
            try
            {

                HttpClient client = new HttpClient();

                // Fetch data:
                string responseString = await client.GetStringAsync("http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/BOOKINGS");

                // Format data:
                // var deserialisedData = JsonConvert.DeserializeObject<loginCheck>(responseString);

                //Console.WriteLine(responseString);

                // Return data:
                return responseString;
            }
            catch (Exception ex)
            {
                return null;
            }
        }

        public async Task<string> FetchJourneyData()
        {
            try
            {

                HttpClient client = new HttpClient();

                // Fetch data:
                string responseString = await client.GetStringAsync("http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/TRAIN_JOURNEY");

                // Format data:
                // var deserialisedData = JsonConvert.DeserializeObject<loginCheck>(responseString);

                //Console.WriteLine(responseString);

                // Return data:
                return responseString;
            }
            catch (Exception ex)
            {
                return null;
            }
        }

        public async Task<string> FetchLocationData()
        {
            try
            {

                HttpClient client = new HttpClient();

                // Fetch data:
                string responseString = await client.GetStringAsync("http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/LOCATIONS");

                // Format data:
                // var deserialisedData = JsonConvert.DeserializeObject<loginCheck>(responseString);

                //Console.WriteLine(responseString);

                // Return data:
                return responseString;
            }
            catch (Exception ex)
            {
                return null;
            }
        }

    }
}