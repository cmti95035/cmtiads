//
//  ViewController.h
//

#import <UIKit/UIKit.h>
#import <AdSdk/AdSdk.h>

@interface ViewController : UIViewController <AdSdkBannerViewDelegate>

@property (strong, nonatomic) AdSdkBannerView *bannerView;

- (IBAction)requestBannerAdvert:(id)sender;

@end
