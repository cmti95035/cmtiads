package com.mobfox.demo;

import java.util.ArrayList;
import java.util.LinkedList;
import java.util.Queue;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.SparseArray;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ListView;
import android.widget.Toast;

import com.adsdk.sdk.Ad;
import com.adsdk.sdk.AdListener;
import com.adsdk.sdk.AdManager;
import com.adsdk.sdk.Gender;
import com.adsdk.sdk.banner.AdView;
import com.adsdk.sdk.nativeads.BaseAdapterUtil;
import com.adsdk.sdk.nativeads.NativeAd;
import com.adsdk.sdk.nativeads.NativeAdListener;
import com.adsdk.sdk.nativeads.NativeAdManager;
import com.adsdk.sdk.nativeads.NativeAdView;
import com.adsdk.sdk.nativeads.NativeViewBinder;

public class MainActivity extends Activity implements AdListener {

	private static final int NUMBER_OF_NATIVE_ADS_TO_BE_LOADED = 5; // number of native ads that should be loaded into queue

	private FrameLayout adFrame; // frame used for banner and native ads display.
	private AdView bannerView;
	private AdManager adManager;

	private int requestsInProgress; // number of native ad requests currently running
	private NativeAdManager nativeAdManager;
	private NativeViewBinder bigNativeAdBinder;
	private View bigNativeAdView;
	private NativeViewBinder smallNativeAdBinder;
	private BaseAdapterUtil baseAdapterUtil; // helper utility for easy displaying of native ads in list views
	private Queue<NativeAd> loadedNativeAds; // queue holding loaded native ads

	private String publisherIdForBannerAds = "226af592e76f7630018ef0a669ad8b2b+4082730088"; // your publisher IDs. NOTE: After you close the app, the Publisher IDs will be saved and used instead of values entered here.
	private String publisherIdForInterstitialAds = "b1b47070b4fec8545c56e358bf9194da+4082730088"; // you can reset entered Publisher IDs by re-installing the application.
	private String publisherIdForNativeAds = "ENTER_PUBLISHER_ID_HERE";
	private final String REQUEST_URL = "http://192.168.1.100/cmtiads/md.request.php";

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		readSavedPublisherIDs();
		setContentView(R.layout.activity_main);
		adFrame = (FrameLayout) findViewById(R.id.adsdkContent);

		adManager = new AdManager(this, REQUEST_URL, publisherIdForInterstitialAds, true);
		adManager.setInterstitialAdsEnabled(true); // enabled by default. Allows the SDK to request static interstitial ads.
		adManager.setVideoAdsEnabled(true); // disabled by default. Allows the SDK to request video fullscreen ads.
		adManager.setPrioritizeVideoAds(true); // disabled by default. If enabled, indicates that SDK should request video ads first, and only if there is no video request a static interstitial (if they are enabled).

		// ArrayList<String> keywords = new ArrayList<String>();
		// keywords.add("cars");
		// keywords.add("money");
		// mManager.setKeywords(keywords); // optional, to send list of keywords (user interests) to ad server.

		adManager.setUserAge(37); // optional, sends user's age
		adManager.setUserGender(Gender.FEMALE); // optional, sends user's gender
		adManager.setListener(this);

		loadedNativeAds = new LinkedList<NativeAd>();
		// ArrayList<String> adTypes = new ArrayList<String>(); // optional, list of ad types that are allowed. You can pass null instead of this.
		// adTypes.add("app");
		nativeAdManager = new NativeAdManager(this, REQUEST_URL, true, publisherIdForNativeAds, createNativeAdListener(), null); // passing null as allowed ad types (last parameter), to indicate that there are no restrictions
		// create binding for native ad
		bigNativeAdBinder = new NativeViewBinder(R.layout.native_ad_layout);
		bigNativeAdBinder.bindTextAsset("headline", R.id.headlineView);
		bigNativeAdBinder.bindTextAsset("description", R.id.descriptionView);
		bigNativeAdBinder.bindImageAsset("icon", R.id.iconView);
		bigNativeAdBinder.bindImageAsset("main", R.id.mainImageView);
		bigNativeAdBinder.bindTextAsset("rating", R.id.ratingBar); // NOTE: "rating" asset is special, RatingBar should be used instead of TextView.
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		getMenuInflater().inflate(R.menu.activity_main, menu);
		return true;
	}

	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		switch (item.getItemId()) {
		case R.id.menu_settings:
			openPublisherIdInputDialog();
			return true;
		default:
			return super.onOptionsItemSelected(item);
		}
	}

	// show dialog for entering Publisher IDs
	@SuppressLint("InflateParams")
	private void openPublisherIdInputDialog() {
		AlertDialog.Builder builder = new AlertDialog.Builder(this);
		builder.setTitle(R.string.publisherIdSetterDialogTitle);
		LayoutInflater inflater = this.getLayoutInflater();
		final View view = inflater.inflate(R.layout.dialog_publisher_ids, new FrameLayout(this));
		builder.setView(view);
		final EditText bannerIDfield = (EditText) view.findViewById(R.id.bannerIDInput);
		bannerIDfield.setText(publisherIdForBannerAds);
		final EditText interstitialIDfield = (EditText) view.findViewById(R.id.interstitialIDInput);
		interstitialIDfield.setText(publisherIdForInterstitialAds);
		final EditText nativeAdIDfield = (EditText) view.findViewById(R.id.nativeAdIDInput);
		nativeAdIDfield.setText(publisherIdForNativeAds);

		builder.setPositiveButton(R.string.doneButtonLabel, new DialogInterface.OnClickListener() {
			@Override
			public void onClick(DialogInterface dialog, int id) {
				publisherIdForBannerAds = bannerIDfield.getText().toString();
				publisherIdForInterstitialAds = interstitialIDfield.getText().toString();
				publisherIdForNativeAds = nativeAdIDfield.getText().toString();
			}
		});

		AlertDialog dialog = builder.create();
		dialog.show();
	}

	private void readSavedPublisherIDs() {
		SharedPreferences sharedPref = getPreferences(MODE_PRIVATE);
		publisherIdForBannerAds = sharedPref.getString(getString(R.string.sharedPreferencesBannerIdKey), publisherIdForBannerAds);
		publisherIdForInterstitialAds = sharedPref.getString(getString(R.string.sharedPreferencesInterstitialIdKey), publisherIdForInterstitialAds);
		publisherIdForNativeAds = sharedPref.getString(getString(R.string.sharedPreferencesNativeAdIdKey), publisherIdForNativeAds);
	}

	private void savePublisherIDs() {
		SharedPreferences.Editor editor = getPreferences(MODE_PRIVATE).edit();
		editor.putString(getString(R.string.sharedPreferencesBannerIdKey), publisherIdForBannerAds);
		editor.putString(getString(R.string.sharedPreferencesInterstitialIdKey), publisherIdForInterstitialAds);
		editor.putString(getString(R.string.sharedPreferencesNativeAdIdKey), publisherIdForNativeAds);
		editor.commit();
	}

	public void onClickShowBanner(View view) {
		removeBanner();
		if (bigNativeAdView != null) {
			adFrame.removeView(bigNativeAdView);
			bigNativeAdView = null;
		}
		ListView listView = (ListView) findViewById(R.id.listView);
		listView.setVisibility(View.GONE);
		Button prepareListViewButton = (Button) findViewById(R.id.prepareListButton);
		prepareListViewButton.setEnabled(true);

		bannerView = new AdView(this, REQUEST_URL, publisherIdForBannerAds, true, true);

		bannerView.setAdspaceWidth(320); // optional, used to set the custom size of banner placement. Without setting it, the SDK will use default sizes.
		bannerView.setAdspaceHeight(50);
		bannerView.setAdspaceStrict(false); // optional, tells the server to only supply banners that are exactly of desired size. Without setting it, the server could also supply smaller ads when no ad of desired size is available.

		ArrayList<String> keywords = new ArrayList<String>();
		keywords.add("sports");
		keywords.add("football");
		bannerView.setKeywords(keywords); // optional, to send list of keywords (user interests) to ad server.
		bannerView.setUserAge(18); // optional, sends user's age
		bannerView.setUserGender(Gender.MALE); // optional, sends user's gender

		bannerView.setAdListener(this);
		adFrame.addView(bannerView);
	}

	private void removeBanner() {
		if (bannerView != null) {
			adFrame.removeView(bannerView);
			bannerView.release();
			bannerView = null;
		}
	}

	public void onClickShowVideoInterstitial(View v) {
		adManager.requestAd(); // request fullscreen ad
	}

	public void onLoadNativeAdButtonClick(View v) {
		if (bigNativeAdView != null) {
			adFrame.removeView(bigNativeAdView);
			bigNativeAdView = null;
		}
		fillNativeAdsQueue();
	}

	public void onShowNativeAdButtonClick(View v) {
		if (bigNativeAdView != null) {
			adFrame.removeView(bigNativeAdView);
			bigNativeAdView = null;
		}
		removeBanner();

		NativeAd nativeAd = loadedNativeAds.poll();
		if (nativeAd == null) {
			Toast.makeText(this, "no native ad loaded!", Toast.LENGTH_SHORT).show();
			return;
		}
		ListView listView = (ListView) findViewById(R.id.listView);
		listView.setVisibility(View.GONE);
		Button prepareListViewButton = (Button) findViewById(R.id.prepareListButton);
		prepareListViewButton.setEnabled(true);

		bigNativeAdView = nativeAdManager.getNativeAdView(nativeAd, bigNativeAdBinder);
		adFrame.addView(bigNativeAdView);
	}

	private void fillNativeAdsQueue() {
		int adsToBeRequested = NUMBER_OF_NATIVE_ADS_TO_BE_LOADED - loadedNativeAds.size() - requestsInProgress;

		for (int i = 0; i < adsToBeRequested; i++) {
			requestsInProgress++;
			nativeAdManager.requestAd();
		}

	}

	private NativeAdListener createNativeAdListener() {
		return new NativeAdListener() {

			@Override
			public void adLoaded(NativeAd ad) {
				Toast.makeText(MainActivity.this, "Native ad loaded", Toast.LENGTH_SHORT).show();
				requestsInProgress--;
				loadedNativeAds.add(ad);
			}

			@Override
			public void adFailedToLoad() {
				Toast.makeText(MainActivity.this, "Ad failed to load", Toast.LENGTH_SHORT).show();
				requestsInProgress--;
			}

			@Override
			public void impression() {
				Toast.makeText(MainActivity.this, "Tracked ad impression", Toast.LENGTH_SHORT).show();
			}

			@Override
			public void adClicked() {
				Toast.makeText(MainActivity.this, "Tracked ad click", Toast.LENGTH_SHORT).show();
			}
		};
	}

	public void onPrepareListButtonClick(View v) {
		if (bigNativeAdView != null) {
			adFrame.removeView(bigNativeAdView);
			bigNativeAdView = null;
		}
		removeBanner();

		smallNativeAdBinder = new NativeViewBinder(R.layout.small_native_ad_layout);
		smallNativeAdBinder.bindTextAsset("headline", R.id.headlineView);
		smallNativeAdBinder.bindImageAsset("icon", R.id.iconView);
		smallNativeAdBinder.bindTextAsset("rating", R.id.ratingBar); // NOTE: "rating" asset is special, RatingBar should be used instead of TextView.

		baseAdapterUtil = new BaseAdapterUtil(3, 5);

		ListView listView = (ListView) findViewById(R.id.listView);
		ArrayAdapterWithAds adapter = new ArrayAdapterWithAds(this, android.R.layout.simple_list_item_1);
		for (int i = 0; i < 55; i++) {
			adapter.add("some text nr: " + i);
		}
		listView.setAdapter(adapter);

		listView.setVisibility(View.VISIBLE);

		v.setEnabled(false);
	}

	// adapter handling list view with native ads
	public class ArrayAdapterWithAds extends ArrayAdapter<String> {
		private SparseArray<NativeAdView> nativeAdViews; // array with already loaded native ad views, used to avoid reloading them when user scrolls back table view

		public ArrayAdapterWithAds(Context context, int resourceId) {
			super(context, resourceId);
			nativeAdViews = new SparseArray<NativeAdView>();
		}

		@Override
		public int getCount() {
			int originalCount = super.getCount();
			return baseAdapterUtil.calculateShiftedCount(originalCount); // add number of ads to number of items in original content
		}

		@Override
		public int getViewTypeCount() {
			int originalCount = super.getViewTypeCount();
			return originalCount + 1; // +1 for native ad view type.
		}

		@Override
		public int getItemViewType(int position) {
			if (baseAdapterUtil.isAdPosition(position)) {
				return getViewTypeCount() - 1; // to return native ad view as last type.
			} else {
				return super.getItemViewType(position); // return your original view type. If you need position index, use shifted position obtained by baseAdapterUtil.calculateShiftedPosition(originalPosition)
			}
		}

		@Override
		public String getItem(int position) {
			int shiftedPosition = baseAdapterUtil.calculateShiftedPosition(position); // calculate shifted position, as feed contains ads and original content
			return super.getItem(shiftedPosition);
		}

		@Override
		public View getView(int position, View convertView, ViewGroup parent) {
			if (baseAdapterUtil.isAdPosition(position)) {
				NativeAdView view;
				view = nativeAdViews.get(position); // we don't want to recreate the view every time user scrolls back the list view
				if (view == null) { // if array with loaded ad views didn't contain ready native ad view, create it:
					NativeAd nativeAd = loadedNativeAds.poll();
					view = nativeAdManager.getNativeAdView(nativeAd, smallNativeAdBinder);
					if (nativeAd != null) {
						nativeAdViews.put(position, view); // store created native ad view in list for reuse
					}
					fillNativeAdsQueue();
				}
				return view;
			} else {
				return super.getView(position, convertView, parent); // return original view
			}
		}
	}

	// Ad listener implementation
	public void adClicked() {
		Toast.makeText(MainActivity.this, "Ad clicked!", Toast.LENGTH_LONG).show();
	}

	public void adClosed(Ad arg0, boolean arg1) {
		Toast.makeText(MainActivity.this, "Ad closed!", Toast.LENGTH_LONG).show();
	}

	public void adLoadSucceeded(Ad arg0) {
		Toast.makeText(MainActivity.this, "Ad load succeeded!", Toast.LENGTH_LONG).show();
		if (adManager != null && adManager.isAdLoaded())
			adManager.showAd();
	}

	public void adShown(Ad arg0, boolean arg1) {
		Toast.makeText(MainActivity.this, "Ad shown!", Toast.LENGTH_LONG).show();
	}

	public void noAdFound() {
		Toast.makeText(MainActivity.this, "No ad found!", Toast.LENGTH_LONG).show();
	}

	@Override
	protected void onStop() {
		savePublisherIDs();
		super.onStop();
	}

	@Override
	protected void onDestroy() {
		super.onDestroy();
		adManager.release();
		if (bannerView != null)
			bannerView.release();
	}
}
