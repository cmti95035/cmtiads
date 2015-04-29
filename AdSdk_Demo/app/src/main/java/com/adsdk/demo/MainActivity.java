package com.adsdk.demo;

import android.app.Activity;
import android.content.Context;
import android.content.pm.ApplicationInfo;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.telephony.TelephonyManager;
import android.util.Log;
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
    private static final String CONNECTOR = "+";
    private static final int sLOCATION_UPDATE_INTERVAL = 60 * 1000; // 1 minutes
    private static final int sLOCATION_UPDATE_DISTANCE = 10; // 10 meters
    private static final boolean IS_LOCATION_NEEDED = true; // set false to disable location

    public void onClickShowBanner(View view) {
        final String REQUEST_URL_BANNER = "http://52.4.145.155/cmtiads/md.request.php";
        final String PUBLISHER_ID_BANNER = "226af592e76f7630018ef0a669ad8b2b" + CONNECTOR + mPhoneNumber;
        if (mAdView != null) {
            removeBanner();
        }

        String idPlus = appendLocationIfNeeded(PUBLISHER_ID_BANNER);
        mAdView = new AdView(this, REQUEST_URL_BANNER,
                idPlus, true, true);
        mAdView.setAdListener(this);
        layout.addView(mAdView);
    }

    private void removeBanner(){
        if(mAdView!=null){
            layout.removeView(mAdView);
            mAdView = null;
        }
    }

    public void onClickShowVideoInterstitial(View v) {
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

        final String REQUEST_URL_FULL = "http://52.4.145.155/cmtiads/md.request.php";
        final String PUBLISHER_ID_FULL = "b1b47070b4fec8545c56e358bf9194da"+ CONNECTOR + mPhoneNumber;

        mLocationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        final LocationListener locationListener = new LocationListener() {
            public void onLocationChanged(Location location) {
                mLongitude = location.getLongitude();
                mLatitude = location.getLatitude();
            }

            public void onStatusChanged(String str, int i, Bundle bdl) {}
            public void onProviderEnabled(String provider) {}
            public void onProviderDisabled(String provider) {}
        };

        mLocationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER,
                sLOCATION_UPDATE_INTERVAL, sLOCATION_UPDATE_DISTANCE, locationListener);

        String idPlus = appendLocationIfNeeded(PUBLISHER_ID_FULL);
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        layout = (RelativeLayout) findViewById(R.id.adsdkContent);
        mManager = new AdManager(this, REQUEST_URL_FULL, idPlus, true);
        mManager.setListener(this);
    }

    private String appendLocationIfNeeded(String str) {
        return IS_LOCATION_NEEDED? appendLocation(str):str;
    }

    private String appendLocation(String str) {
        Location loc = mLocationManager.getLastKnownLocation(LocationManager.GPS_PROVIDER);
        if (loc == null) {
            return str;
        }
        mLongitude = loc.getLongitude();
        mLatitude = loc.getLatitude();
        return str + CONNECTOR + mLongitude + CONNECTOR + mLatitude;
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
    protected void onDestroy() {
        super.onDestroy();
        mManager.release();
        if(mAdView!=null)
            mAdView.release();
    }
}
