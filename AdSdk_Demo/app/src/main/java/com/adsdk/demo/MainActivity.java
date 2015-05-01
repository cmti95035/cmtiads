package com.adsdk.demo;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.os.Handler;
import android.os.ResultReceiver;
import android.telephony.TelephonyManager;
import android.view.Menu;
import android.view.View;
import android.widget.RelativeLayout;
import android.widget.Toast;

import com.adsdk.sdk.Ad;
import com.adsdk.sdk.AdListener;
import com.adsdk.sdk.AdManager;
import com.adsdk.sdk.banner.AdView;

public class MainActivity extends Activity implements AdListener {

    private RelativeLayout layout;
    private AdView mAdView;
    private AdManager mManager;
    private String mPhoneNumber;
    private LocationManager mLocationManager;
    private double mLongitude;
    private double mLatitude;
    public static final String CONNECTOR = "+";
    private static final int sLOCATION_UPDATE_INTERVAL = 10 * 1000; // 1 minutes
    private static final int sLOCATION_UPDATE_DISTANCE = 10; // 10 meters
    private boolean mIsLocationNeeded = true; // set false to disable location
    private String mCurrLocService;
    private AddressResultReceiver mResultReceiver;
    private static final String REQUEST_URL_BANNER = "http://52.4.145.155/cmtiads/md.request.php";
    private static final String REQUEST_URL_FULL = "http://52.4.145.155/cmtiads/md.request.php";
    private String mPublishIdBanner;
    private String mPublishIdFull;
    private boolean mIsBannerRequested = false;


    private final LocationListener mLocationListener = new LocationListener() {
        public void onLocationChanged(Location location) {
            mLongitude = location.getLongitude();
            mLatitude = location.getLatitude();
        }

        public void onStatusChanged(String str, int i, Bundle bdl) {
        }

        public void onProviderEnabled(String provider) {
            resetLocationService();
        }

        public void onProviderDisabled(String provider) {
            resetLocationService();
        }
    };

    private void resetLocationService() {
        stopLocationUpdates();
        setupLocationServiceIfNeeded();
    }

    public void onClickShowBanner(View view) {

        if (mAdView != null) {
           removeBanner();
        }

        mIsBannerRequested = true;
        if (!appendLocationIfNeeded()) {
            mAdView = new AdView(this, REQUEST_URL_BANNER,
                    mPublishIdBanner, true, true);
            mAdView.setAdListener(this);
            layout.addView(mAdView);
        }
    }

    private void removeBanner(){
        if(mAdView!=null){
            layout.removeView(mAdView);
            mAdView = null;
        }
    }

    public void onClickShowVideoInterstitial(View v) {
        mIsBannerRequested = false;
        mManager.requestAd();
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        try {
            mPhoneNumber = ( (TelephonyManager) getSystemService(Context.TELEPHONY_SERVICE)).getLine1Number();
        } finally {
            if ( mPhoneNumber == null) {
                mPhoneNumber = "00000000000";
            }
        }

        mPublishIdFull = "b1b47070b4fec8545c56e358bf9194da"+ CONNECTOR + mPhoneNumber;
        mPublishIdBanner = "226af592e76f7630018ef0a669ad8b2b" + CONNECTOR + mPhoneNumber;
        mResultReceiver = new AddressResultReceiver(new Handler());
        setupLocationServiceIfNeeded();

        //String idPlus = appendLocationIfNeeded(PUBLISHER_ID_FULL);
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        layout = (RelativeLayout) findViewById(R.id.adsdkContent);
        if (!appendLocationIfNeeded()) {
            mManager = new AdManager(this, REQUEST_URL_FULL, mPublishIdFull, true);
            mManager.setListener(this);
        }
    }

    private void setupLocationServiceIfNeeded() {
        if (mIsLocationNeeded) {
            setupLocationService();
        }
    }

    /**
     *  If GPS is not enabled, it will fall back to a coarse GPS location service
     * i.e., network address, cellular tower etc.. In real production, need consider
     * flight mode, which does not have any service. For prototyping, we assume, user
     * has at least wifi or cellular enabled.
     */

    private void setupLocationService() {
        mLocationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);

        if (mLocationManager.isProviderEnabled(LocationManager.GPS_PROVIDER)) {
            mLocationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER,
                    sLOCATION_UPDATE_INTERVAL, sLOCATION_UPDATE_DISTANCE, mLocationListener);
            mCurrLocService = LocationManager.GPS_PROVIDER;
        } else {
            mLocationManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER,
                    sLOCATION_UPDATE_INTERVAL, sLOCATION_UPDATE_DISTANCE, mLocationListener);
            mCurrLocService = LocationManager.NETWORK_PROVIDER;
        }
    }

    /**
     *
     * @return true if locations is need and location can be retrieved from provider,
     * false if location is not needed or cannot retrieve from provider
     */
    private boolean appendLocationIfNeeded() {
        return mIsLocationNeeded && appendLocation();
    }

    private boolean appendLocation() {
        Location loc = mLocationManager.getLastKnownLocation(mCurrLocService);
        if (loc == null) {
            return false;
        }
        mLongitude = loc.getLongitude();
        mLatitude = loc.getLatitude();
        startIntentService(loc);
        return true;
    }

    /**
     * Creates an intent, adds location data to it as an extra, and starts the intent service for
     * fetching an address.
     */
    protected void startIntentService(Location loc) {
        // Create an intent for passing to the intent service responsible for fetching the address.
        Intent intent = new Intent(this, FetchAddressIntentService.class);

        // Pass the result receiver as an extra to the service.
        intent.putExtra(Constants.RECEIVER, mResultReceiver);

        // Pass the location data as an extra to the service.
        intent.putExtra(Constants.LOCATION_DATA_EXTRA, loc);

        // Start the service. If the service isn't already running, it is instantiated and started
        // (creating a process for it if needed); if it is running then it remains running. The
        // service kills itself automatically once all intents are processed.
        startService(intent);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_main, menu);
        return true;
    }

    public void adClicked() {
    }

    public void adClosed(Ad arg0, boolean arg1) {
    }

    public void adLoadSucceeded(Ad arg0) {
        if (mManager != null && mManager.isAdLoaded())
            mManager.showAd();
    }

    public void adShown(Ad arg0, boolean arg1) {
    }

    public void noAdFound() {
        Toast.makeText(MainActivity.this, "No ad found!", Toast.LENGTH_LONG)
                .show();
    }

    @Override
    protected void onPause() {
        super.onPause();
        stopLocationUpdates();
    }

    protected void stopLocationUpdates() {
        mLocationManager.removeUpdates(mLocationListener);
    }

    @Override
    public void onResume() {
        super.onResume();
        setupLocationServiceIfNeeded();
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        mManager.release();
        if(mAdView!=null)
            mAdView.release();
    }

    private void requestWithLocation() {
        String idPlus = mIsBannerRequested ?
                mPublishIdBanner + CONNECTOR + "0" + CONNECTOR +
                        mLongitude + CONNECTOR + mLatitude :
                mPublishIdFull + CONNECTOR + "0" + CONNECTOR +
                        mLongitude + CONNECTOR + mLatitude;

        request(idPlus);
    }

    private void requestWithAddress(String addrInfo) {
        String idPlus = mIsBannerRequested ?
                mPublishIdBanner + CONNECTOR + "1" + CONNECTOR + addrInfo:
                mPublishIdFull + CONNECTOR + "1" + CONNECTOR + addrInfo;

        request(idPlus);
    }

    private void request(String idPlus) {
        if ( mIsBannerRequested) {
            mAdView = new AdView(this, REQUEST_URL_BANNER,
                    idPlus, true, true);
            mAdView.setAdListener(this);
            layout.addView(mAdView);
        } else {
            mManager = new AdManager(this, REQUEST_URL_FULL, idPlus, true);
            mManager.setListener(this);
        }
    }

    /**
     * Receiver for data sent from FetchAddressIntentService.
     */
    class AddressResultReceiver extends ResultReceiver {
        public AddressResultReceiver(Handler handler) {
            super(handler);
        }

        /**
         *  Receives data sent from FetchAddressIntentService and updates the UI in MainActivity.
         */
        @Override
        protected void onReceiveResult(int resultCode, Bundle resultData) {

            // no address info, send in lat/log, let server handle
            if (resultCode != Constants.SUCCESS_RESULT) {
                requestWithLocation();
            } else {
                String addrInfo = resultData.getString(Constants.RESULT_DATA_KEY);
                requestWithAddress(addrInfo);
            }
        }
    }
}
