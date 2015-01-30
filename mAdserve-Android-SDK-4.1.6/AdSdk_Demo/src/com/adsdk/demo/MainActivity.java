package com.adsdk.demo;

import com.adsdk.sdk.Ad;
import com.adsdk.sdk.AdListener;
import com.adsdk.sdk.AdManager;
import com.adsdk.sdk.banner.AdView;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;
import android.view.View;
import android.widget.RelativeLayout;
import android.widget.Toast;

public class MainActivity extends Activity implements AdListener {
	private RelativeLayout layout;
	private AdView mAdView;
	private AdManager mManager;
	

	public void onClickShowBanner(View view) {
	    final String REQUEST_URL_BANNER = "http://10.32.42.221/cmtiads/md.request.php";
	    final String PUBLISHER_ID_BANNER = "226af592e76f7630018ef0a669ad8b2b";
		if (mAdView != null) {
			removeBanner();
		}
		mAdView = new AdView(this, REQUEST_URL_BANNER,
		        PUBLISHER_ID_BANNER, true, true);
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
        final String REQUEST_URL_FULL = "http://10.32.42.221/cmtiads/md.request.php";
        final String PUBLISHER_ID_FULL = "b1b47070b4fec8545c56e358bf9194da";

		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		layout = (RelativeLayout) findViewById(R.id.adsdkContent);
		mManager = new AdManager(this, REQUEST_URL_FULL ,
		        PUBLISHER_ID_FULL, true);
		mManager.setListener(this);
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
