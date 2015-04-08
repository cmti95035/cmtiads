//
//  ViewController.h
//

#import <UIKit/UIKit.h>
#import <AdSdk/AdSdk.h>

@interface ViewController : UIViewController <AdSdkVideoInterstitialViewControllerDelegate>

@property (nonatomic, strong) AdSdkVideoInterstitialViewController *videoInterstitialViewController;

- (IBAction)requestInterstitialAdvert:(id)sender;

@end
