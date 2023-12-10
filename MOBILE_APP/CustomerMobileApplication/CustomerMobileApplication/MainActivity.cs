using Android.App;
using Android.Widget;
using Android.OS;
using Android.Content;
using CustomerMobileApplication.Resources;
using System.Threading.Tasks;
using System.Collections.Generic;
using System;
using System.Net.Http;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;
using System.Security.Cryptography;
using System.Text;
using System.Linq;

namespace CustomerMobileApplication
{
    [Activity(Label = "Connected Rail", MainLauncher = true, Icon = "@drawable/Logo_green")]
    public class MainActivity : Activity
    {
        private string url = "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/passengers";
        private HttpClient client = new HttpClient();

        // Declare the widgets used in main activity (login activity):
        private EditText   emailAddress;
        private EditText   password;
        private Button     login;
        private TextView   forgotPassword;
        private TextView   register;

        // Load the UI:
        protected override void OnCreate(Bundle savedInstanceState)
        {
            
            base.OnCreate(savedInstanceState);

            // Set our view from the "main" layout resource
            SetContentView(Resource.Layout.Main);

            // Bind the above widgets to their instances in the layout:
            emailAddress =      FindViewById<EditText>(Resource.Id.etInputEmail);
            password =          FindViewById<EditText>(Resource.Id.etInputPassword);
            login =             FindViewById<Button>(Resource.Id.btnLogin);
            forgotPassword =    FindViewById<TextView>(Resource.Id.tvForgottenPassword);
            register =          FindViewById<TextView>(Resource.Id.tvRegister);

            // Check if the user is already logged in.
            // If so, auto-log them in, otherwise, display the login page as intended.
            CheckIfAlreadyLoggedIn();

            ImageView loginLogo = FindViewById<ImageView>(Resource.Id.ivLoginLogo);
            loginLogo.SetImageResource(Resource.Drawable.Connected_Rail);

            System.Diagnostics.Debug.WriteLine("Startup initiated");


            // Set on-click handler for login button click:
            login.Click += async delegate
            {
                // User EditText inputs
                EditText inputEmail = FindViewById<EditText>(Resource.Id.etInputEmail);
                EditText inputPassword = FindViewById<EditText>(Resource.Id.etInputPassword);
                
                // GETTING all users from the database, and making a list of Json objects
                string allUsers = await FetchLoginData();
                List<Passenger> parsedJSON = JsonConvert.DeserializeObject<List<Passenger>>(allUsers);

                // Loops through all passengers, and finds the one equivelant to user input
                foreach(Passenger lp in parsedJSON)
                {

                    //Disable button (so user doesn't press again, and overstack
                    login.Clickable = false;

                    string hashedPW = HashSHA256(inputPassword.Text);

                    if (inputEmail.Text == lp.EMAIL_ADDRESS && inputPassword.Text == lp.PASSWORD)
                    {
                        // Login here...
                        //StartActivity(typeof(Create_Booking));
                        //Finish();

                        // Make new passenger with lp details
                        Passenger newPassenger = new Passenger();
                        newPassenger.DATE_OF_BIRTH = lp.DATE_OF_BIRTH;
                        newPassenger.EMAIL_ADDRESS = lp.EMAIL_ADDRESS;
                        newPassenger.FIRST_NAME = lp.FIRST_NAME;
                        newPassenger.GENDER = lp.GENDER;
                        newPassenger.ID = lp.ID;
                        newPassenger.LAST_NAME = lp.LAST_NAME;
                        newPassenger.PASSWORD = lp.PASSWORD;

                        // Start new activity, passing new passenger as parameter
                        var intent = new Intent(this, typeof(Create_Booking));
                        intent.PutExtra("Passenger", JsonConvert.SerializeObject(newPassenger));
                        StartActivity(intent);
                        Finish();
                    }
                }

                Console.WriteLine("HASH ONE -----------------" + HashSHA256(inputPassword.Text));
                Console.WriteLine("HASH TWO -----------------" + ComputeSha1(inputPassword.Text));

                // If details are incorrect
                AlertDialog.Builder popup = new AlertDialog.Builder(this);
                popup.SetTitle("ERROR");
                popup.SetMessage("Email or Password incorrect. Please try again.");
                popup.SetNeutralButton("OK", delegate
                {
                    // Clear password TextView
                    string cleared = "";
                    inputPassword.Text = cleared;
                });

                popup.Show();

                // Reanable button
                login.Clickable = true;

            };

            // User has forgotten their password:
            forgotPassword.Click += delegate
            {
                // TODO
                // Discuss what approach the team wants to take for this piece of functionality.
            };

            // User wishes to register for an account:
            register.Click += delegate
            {
                // TODO
                // Take the user to the registration page.
            };

            

        }

        /// <summary>
        /// Method to check if this application already has an active user.
        /// If so log them in, otherwise keep the login page displayed and pass back to calling function.
        /// </summary>
        protected void CheckIfAlreadyLoggedIn()
        {
            // TODO
            // Check contents of the current user file, if content exists, load it. 
            // Otherwise (it's empty for example), do nothing (remain inside this view + activity). 
        }
        
        

        public async Task<string> FetchLoginData()
        {
            try
            {

                HttpClient client = new HttpClient();

                // Fetch data:
                string responseString = await client.GetStringAsync("http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/PASSENGERS");
                
                // Format data:
               // var deserialisedData = JsonConvert.DeserializeObject<loginCheck>(responseString);

                // Return data:
                return responseString;
            }
            catch (Exception ex)
            {
                return null;
            }
        }

        /// <summary>
        /// Hash password to SHA256
        /// </summary>
        /// <param name="value"></param>
        /// <returns></returns>
        public string HashSHA256(string value)
        {
            using (var sha = SHA256.Create())
            {
                return Convert.ToBase64String(sha.ComputeHash(System.Text.Encoding.UTF8.GetBytes(value)));
            }
        }

        /// <summary>
        /// Hash password to SHA1
        /// </summary>
        /// <param name="data"></param>
        /// <returns></returns>
        public static string ComputeSha1(string data)
        {
            var sha1Digest = new Org.BouncyCastle.Crypto.Digests.Sha1Digest();
            var hash = new byte[sha1Digest.GetDigestSize()];

            var dataBytes = Encoding.UTF8.GetBytes(data);
            foreach (var b in dataBytes)
            {
                sha1Digest.Update(b);
            }
            sha1Digest.DoFinal(hash, 0);

            return string.Join("", hash.Select(b => b.ToString("x2")).ToArray());
        }

    }
}

