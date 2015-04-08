

#import <UIKit/UIKit.h>

enum {
    AdSdkInterstitialViewErrorUnknown = 0,
    AdSdkInterstitialViewErrorServerFailure = 1,
    AdSdkInterstitialViewErrorInventoryUnavailable = 2,
};

typedef enum {
    AdSdkAdTypeVideoToInterstitial = 0,
    AdSdkAdTypeVideo = 1,
    AdSdkAdTypeInterstitial = 2,
    AdSdkAdTypeInterstitialToVideo = 3,
    AdSdkAdTypeNoAdInventory = 4,
    AdSdkAdTypeError = 5,
    AdSdkAdTypeUnknown = 6
} AdSdkAdType;

typedef enum {
    AdSdkAdGroupVideo = 0,
    AdSdkAdGroupInterstitial = 1
} AdSdkAdGroupType;

@class AdSdkVideoInterstitialViewController;
@class AdSdkAdBrowserViewController;

@protocol AdSdkVideoInterstitialViewControllerDelegate <NSObject>

- (NSString *)publisherIdForAdSdkVideoInterstitialView:(AdSdkVideoInterstitialViewController *)videoInterstitial;

@optional

- (void)adsdkVideoInterstitialViewDidLoadAdSdkAd:(AdSdkVideoInterstitialViewController *)videoInterstitial advertTypeLoaded:(AdSdkAdType)advertType;

- (void)adsdkVideoInterstitialView:(AdSdkVideoInterstitialViewController *)banner didFailToReceiveAdWithError:(NSError *)error;

- (void)adsdkVideoInterstitialViewActionWillPresentScreen:(AdSdkVideoInterstitialViewController *)videoInterstitial;

- (void)adsdkVideoInterstitialViewWillDismissScreen:(AdSdkVideoInterstitialViewController *)videoInterstitial;

- (void)adsdkVideoInterstitialViewDidDismissScreen:(AdSdkVideoInterstitialViewController *)videoInterstitial;

- (void)adsdkVideoInterstitialViewActionWillLeaveApplication:(AdSdkVideoInterstitialViewController *)videoInterstitial;

@end

@interface AdSdkVideoInterstitialViewController : UIViewController
{

    BOOL advertLoaded;
	BOOL advertViewActionInProgress;

    BOOL locationAwareAdverts;

    __unsafe_unretained id <AdSdkVideoInterstitialViewControllerDelegate> delegate;

    AdSdkAdBrowserViewController *_browser;

    NSString *requestURL;

}

@property (nonatomic, assign) IBOutlet __unsafe_unretained id <AdSdkVideoInterstitialViewControllerDelegate> delegate;

@property (nonatomic, readonly, getter=isAdvertLoaded) BOOL advertLoaded;
@property (nonatomic, readonly, getter=isAdvertViewActionInProgress) BOOL advertViewActionInProgress;

@property (nonatomic, assign) BOOL locationAwareAdverts;

@property (nonatomic, strong) NSString *requestURL;

- (void)requestAd;

- (void)presentAd:(AdSdkAdType)advertType;

- (void)setLocationWithLatitude:(CGFloat)latitude longitude:(CGFloat)longitude;

- (void)requestDemoVideoAdvert; 
- (void)requestDemoInterstitualAdvert;
- (void)requestDemoVideoToInterstitualAdvert;
- (void)requestDemoInterstitualToVideoAdvert;

@end

extern NSString * const AdSdkVideoInterstitialErrorDomain;