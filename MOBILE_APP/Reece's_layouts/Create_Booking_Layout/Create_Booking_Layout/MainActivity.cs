using Android.App;
using Android.Widget;
using Android.OS;
using Android.Support.V7.App;

namespace Create_Booking_Layout
{
    [Activity(Label = "@string/app_name", Theme = "@style/AppTheme", MainLauncher = true)]
    public class MainActivity : AppCompatActivity
    {
        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);

            // Set our view from the "main" layout resource
            SetContentView(Resource.Layout.activity_main);

            /*
            // Code for location spinners ///////////////////////////////////////////
            var spinner_locationOne = FindViewById<Spinner>(Resource.Id.spinner_locationOne);
            var spinner_locationTwo = FindViewById<Spinner>(Resource.Id.spinner_locationTwo);

            var adapterLocations = ArrayAdapter.CreateFromResource(this, Resource.Array.locations, Android.Resource.Layout.SimpleSpinnerItem);
            adapterLocations.SetDropDownViewResource(Android.Resource.Layout.SimpleSpinnerDropDownItem);
            spinner_locationOne.Adapter = adapterLocations;
            spinner_locationTwo.Adapter = adapterLocations;

            spinner_locationOne.ItemSelected += (s, e) => {
                string firstItem = spinner_locationOne.SelectedItem.ToString();

                if (firstItem.Equals(spinner_locationOne.SelectedItem.ToString()))
                {
                    // To do when first item is selected
                }
                else
                {
                    Toast.MakeText(this, "You have selected:" + e.Parent.GetItemAtPosition(e.Position).ToString(), ToastLength.Short).Show();
                }
            };
            */

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

            /*
            // Code for time spinners ///////////////////////////////////////////
            var spinner_outbound = FindViewById<Spinner>(Resource.Id.spinner_outbound);
            var spinner_return = FindViewById<Spinner>(Resource.Id.spinner_return);

            var adapterTimes = ArrayAdapter.CreateFromResource(this, Resource.Array.times, Android.Resource.Layout.SimpleSpinnerItem);
            adapterLocations.SetDropDownViewResource(Android.Resource.Layout.SimpleSpinnerDropDownItem);
            spinner_outbound.Adapter = adapterTimes;
            spinner_return.Adapter = adapterTimes;

            // Code for adult/child spinners ///////////////////////////////////////////
            var spinner_adults = FindViewById<Spinner>(Resource.Id.spinner_adults);
            var spinner_children = FindViewById<Spinner>(Resource.Id.spinner_children);

            var adapterNumbers = ArrayAdapter.CreateFromResource(this, Resource.Array.numbers, Android.Resource.Layout.SimpleSpinnerItem);
            adapterNumbers.SetDropDownViewResource(Android.Resource.Layout.SimpleSpinnerDropDownItem);
            spinner_adults.Adapter = adapterNumbers;
            spinner_children.Adapter = adapterNumbers;

            // Code for railcard spinners ///////////////////////////////////////////
            var spinner_railcards = FindViewById<Spinner>(Resource.Id.spinner_adults);

            var adapterRailcards = ArrayAdapter.CreateFromResource(this, Resource.Array.numbers, Android.Resource.Layout.SimpleSpinnerItem);
            adapterRailcards.SetDropDownViewResource(Android.Resource.Layout.SimpleSpinnerDropDownItem);
            spinner_railcards.Adapter = adapterRailcards;
            */

        }

    }
}

