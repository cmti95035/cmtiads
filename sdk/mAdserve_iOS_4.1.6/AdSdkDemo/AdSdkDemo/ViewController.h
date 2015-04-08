//
//  ViewController.h
//

#import <UIKit/UIKit.h>
#import <AdSdk/AdSdk.h>

@interface ViewController : UIViewController <AdSdkVideoInterstitialViewControllerDelegate, AdSdkBannerViewDelegate>

@property (nonatomic, strong) AdSdkVideoInterstitialViewController *videoInterstitialViewController;
@property (strong, nonatomic) AdSdkBannerView *bannerView;


- (IBAction)requestInterstitialAdvert:(id)sender;
- (IBAction)requestBannerAdvert:(id)sender;

@end
