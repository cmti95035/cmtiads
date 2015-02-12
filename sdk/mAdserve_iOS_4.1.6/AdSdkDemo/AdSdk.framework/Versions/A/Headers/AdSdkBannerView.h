

#import <UIKit/UIKit.h>

enum {
    AdSdkErrorUnknown = 0,
    AdSdkErrorServerFailure = 1,
    AdSdkErrorInventoryUnavailable = 2,
};

@class AdSdkBannerView;

@protocol AdSdkBannerViewDelegate <NSObject>

- (NSString *)publisherIdForAdSdkBannerView:(AdSdkBannerView *)banner;

@optional

- (void)adsdkBannerViewDidLoadAdSdkAd:(AdSdkBannerView *)banner;

- (void)adsdkBannerViewDidLoadRefreshedAd:(AdSdkBannerView *)banner;

- (void)adsdkBannerView:(AdSdkBannerView *)banner didFailToReceiveAdWithError:(NSError *)error;

- (BOOL)adsdkBannerViewActionShouldBegin:(AdSdkBannerView *)banner willLeaveApplication:(BOOL)willLeave;

- (void)adsdkBannerViewActionWillPresent:(AdSdkBannerView *)banner;

- (void)adsdkBannerViewActionWillFinish:(AdSdkBannerView *)banner;

- (void)adsdkBannerViewActionDidFinish:(AdSdkBannerView *)banner;

- (void)adsdkBannerViewActionWillLeaveApplication:(AdSdkBannerView *)banner;

@end

@interface AdSdkBannerView : UIView 
{
	NSString *advertisingSection;
	BOOL bannerLoaded;
	BOOL bannerViewActionInProgress;
	UIViewAnimationTransition refreshAnimation;
	__unsafe_unretained id <AdSdkBannerViewDelegate> delegate;

	UIImage *_bannerImage;
	BOOL _tapThroughLeavesApp;
	BOOL _shouldScaleWebView;
	BOOL _shouldSkipLinkPreflight;
	BOOL _statusBarWasVisible;
	NSURL *_tapThroughURL;
	NSInteger _refreshInterval;
	NSTimer *_refreshTimer;
    BOOL refreshTimerOff;
    NSString *requestURL;

}

@property (nonatomic, assign) IBOutlet __unsafe_unretained id <AdSdkBannerViewDelegate> delegate;
@property (nonatomic, copy) NSString *advertisingSection;
@property (nonatomic, assign) UIViewAnimationTransition refreshAnimation;

@property (nonatomic, readonly, getter=isBannerLoaded) BOOL bannerLoaded;
@property (nonatomic, readonly, getter=isBannerViewActionInProgress) BOOL bannerViewActionInProgress;

@property (nonatomic, assign) BOOL    refreshTimerOff;

@property (strong, nonatomic) NSString *requestURL;

@property (nonatomic, assign) BOOL allowDelegateAssigmentToRequestAd;

- (void)requestAd;

- (void)requestDemoBannerImageAdvert; 
- (void)requestDemoBannerTextAdvert;
- (void)requestDemoBannerTextSkipOverlayInAppAdvert;
- (void)requestDemoBannerTextSkipOverlaySafariAdvert;

@end

extern NSString * const AdSdkErrorDomain;